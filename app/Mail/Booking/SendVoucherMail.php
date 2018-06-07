<?php

namespace App\Mail\Booking;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendVoucherMail extends Mailable {
    use Queueable, SerializesModels;

    public $data;
    public $path;

    public function __construct($data) {
        $this->data = $data;
        $this->path = storage_path('/tmp/pdf/');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {

      $data = $this->data;
      $pdf = $this->path . 'voucher-' . $data['code'] . '.pdf';
      return $this->view('Emails.Booking.SendVoucher', $data)
                ->subject('Voucher - #' . $data['code'])
                ->attach($pdf);
    }
}
