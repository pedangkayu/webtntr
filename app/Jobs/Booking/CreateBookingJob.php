<?php

namespace App\Jobs\Booking;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\data_booking;

class CreateBookingJob implements ShouldQueue {
    use InteractsWithQueue, Queueable, SerializesModels;

    public $req;

    public function __construct(array $req) {
        $this->req = $req;
    }

    public function handle() {
      $data_booking = $this->req;
      unset($data_booking['_token']);
      try {
        \DB::begintransaction();
        $this->checkode(function($kode) use ($data_booking){
          $data_booking['code'] = $kode;
          $spa = data_booking::create($data_booking);
        });
        \DB::commit();
        session()->flash('notif', [
            'id' => $booking->id_booking,
            'label' => 'success',
            'err' => $data_booking['booking'] . ' was saved'
        ]);
      } catch (\Exception $e) {
        \DB::rollback();
        session()->flash('notif', [
            'id' => 0,
            'label' => 'danger',
            'err' => $e->getMessage()
        ]);
      }

    }

    private function checkode($next){
      $kode = $this->kode();
      $count = where('code', $kode)->where('status', 1)->count();
      if($count > 0)
        return $this->checkode($next);
      else
        return $next($kode);
    }

    private function kode(){
      $kode = substr(md5(microtime()),rand(0,26),5);
    }

}
