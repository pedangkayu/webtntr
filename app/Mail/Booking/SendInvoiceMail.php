<?php

namespace App\Mail\Booking;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $path;

    public function __construct($data) {
        $this->data = $data;
        $this->path = storage_path('/tmp/pdf/');
    }

    public function build() {
        $data = $this->data->toArray();
        $pdf = $this->path . 'invoice-' . $data['code'] . '.pdf';
        return $this->view('Emails.Booking.SendInvoice', $data)
                  ->subject('Invoice - #' . $data['code'])
                  ->attach($pdf);
    }
}
