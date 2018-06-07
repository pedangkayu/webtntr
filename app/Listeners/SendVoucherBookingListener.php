<?php

namespace App\Listeners;

use Mail;

use App\Events\Booking\SendVoucherBookingEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\data_booking;
use App\Models\data_share_profit_bandung;

use App\Mail\Booking\SendVoucherMail;

class SendVoucherBookingListener {

    public $path;

    public function __construct() {
        $this->path = storage_path('/tmp/pdf/');
    }

    public function handle(SendVoucherBookingEvent $event) {

      $to = $event->data['email'];
      // Ceate PDF file
      $file = $this->path . 'voucher-' . $event->data['code'] . '.pdf';
      $data = $event->data;

      $pdf = \PDF::loadView('Pdf.Booking.Voucher', $data)->save($file);

      $bcc[] = $data['config']['bcc_booking_email'];
      $bcc[] = $data['config']['email'];

      if($event->data['premium'] > 0)
        $bcc[] = $data['spa_email'];

      Mail::to($to)
        ->bcc($bcc)
        ->send(new SendVoucherMail($data));
      session()->flash('err', [
        'err' => 'Invoice was sent successfully'
      ]);
      data_booking::where('id_booking', $event->data['id_booking'])
        ->update([
          'status' => 3 // paid
        ]);

      // Share Profit
      $profit = data_share_profit_bandung::firstOrCreate([
        'id_booking' => $event->data['id_booking']
      ]);
      $total = $event->data['grandtotal'];
      $subtotal = ($total * $event->data['config']['share_profit']) / 100;
      $profit->update([
        'total' => $total,
        'currenci_id' => $event->data['currenci_id'],
        'share_profit' => $event->data['config']['share_profit'],
        'subtotal' => $subtotal,
        'status' => 1
      ]);

      if(file_exists($file))
        @unlink($file);

    }
}
