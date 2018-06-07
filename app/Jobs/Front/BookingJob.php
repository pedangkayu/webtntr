<?php

namespace App\Jobs\Front;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\data_booking;
use App\Models\data_servicepack;
use App\Models\Views\view_booking_detail;
use App\Events\Booking\CreateBookingEvent;

class BookingJob implements ShouldQueue {

    use InteractsWithQueue, Queueable, SerializesModels;
    public $req;
    public $booking;

    public function __construct(array $req) {
        $this->req = $req;
    }

    public function handle() {
      $data_booking = $this->req;
      unset($data_booking['_token']);
      try {
        $service = data_servicepack::find($this->req['id_servicepack']);
        if($service == null)
          throw new \Exception("Service or Package not found", 1);

          $data_booking['checkin_hotel'] = empty($this->req['checkin_hotel']) ? date('Y-m-d') : $this->req['checkin_hotel'];

          // Matematika
          $subtotal = $service->price_publish;
          $disc = $service->discount;
          $person = $this->req['qty_person'];

          $total = $subtotal * $person;
          $aftdisc = ($total * $disc) / 100;
          $grandtotal = $total - $aftdisc;
           // End Matematika

           $data_booking['subtotal'] = $subtotal;
           $data_booking['discount'] = $disc;
           $data_booking['grandtotal'] = $grandtotal;

          \DB::begintransaction();
            $this->checkode(function($kode) use ($data_booking){
            $data_booking['code'] = $kode;
            $this->booking = data_booking::create($data_booking);
          });
          \DB::commit();

          // Send email
          $params = view_booking_detail::find($this->booking->id_booking);
          $params['config'] = \Format::paladin();
          event(new CreateBookingEvent($params));

          session()->flash('notif', [
              'result' => true,
              'data' => $this->booking
          ]);
      } catch (\Exception $e) {
        \DB::rollback();
        session()->flash('notif', [
            'result' => false,
            'err' => $e->getMessage()
        ]);
      }

    }

    private function checkode($next){
      $kode = strtoupper($this->kode());
      $count = data_booking::where('code', $kode)->count();
      if($count > 0)
        return $this->checkode($next);
      else
        return $next($kode);
    }

    private function kode(){
      $acak = sha1(microtime());
      return substr($acak, rand(0, ( strlen($acak) - 5 )), 5);
    }
}
