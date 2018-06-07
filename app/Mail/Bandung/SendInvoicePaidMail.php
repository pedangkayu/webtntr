<?php

namespace App\Mail\Bandung;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendInvoicePaidMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $path;

    public function __construct($data) {
        $this->data = $data;
        $this->path = storage_path('/tmp/pdf/');
    }

    public function build() {
        return $this->view('Emails.Bandung.SendInvoicePaid', $this->data)
            ->attach($this->data['file'])
            ->subject('Pembayaran Dari Profit Share');

    }
}
