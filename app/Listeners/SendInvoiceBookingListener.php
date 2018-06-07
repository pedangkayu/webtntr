<?php

namespace App\Listeners;

use Mail;

use App\Events\Booking\SendInvoiceBookingEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\data_booking;

use App\Mail\Booking\SendInvoiceMail;
class SendInvoiceBookingListener {

  public $path;

    public function __construct() {
        $this->path = storage_path('/tmp/pdf/');
    }

    public function handle(SendInvoiceBookingEvent $event) {
      $to = $event->data->email;
      // Ceate PDF file
      $file = $this->path . 'invoice-' . $event->data->code . '.pdf';
      $data = $event->data;
      $data['config'] = \Format::paladin();

      $subtotal = $event->data->subtotal;
      $person =  $subtotal * $event->data->qty_person;
      $aftdisc = ($person * $event->data->discount) / 100;
      $total = $person - $aftdisc;
      $other = $event->data->total_other;
      $totalWother = $total + $other;
      $tax = ($totalWother * $event->data->tax) / 100;
      $grandtotal = $totalWother + $tax;

      $data['total_qty_person'] = $person;
      $data['total_total'] = $total;
      $data['total_discount'] = $aftdisc;
      $data['total_total_other'] = $other;
      $data['total_tax'] = $tax;
      $data['grandtotal'] = $grandtotal;


      $pdf = \PDF::loadView('Pdf.Booking.Invoice', $data)->save($file);

      if($event->data->premium > 0)
        $bcc[] = $event->data->spa_email;

      $bcc[] = $data['config']->bcc_booking_email;
      $bcc[] = $data['config']->email;

      Mail::to($to)
        ->bcc($bcc)
        ->send(new SendInvoiceMail($data));
      session()->flash('err', [
        'err' => 'Invoice was sent successfully'
      ]);
      data_booking::where('id_booking', $event->data->id_booking)
        ->where('status', 1)
        ->update([
          'status' => 2
        ]);
      if(file_exists($file))
        @unlink($file);

    }
}
