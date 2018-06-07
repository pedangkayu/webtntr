<?php

namespace App\Mail\Bandung;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendInvoiceTeamMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $path;

    public function __construct($data) {
        $this->data = $data;
        $this->path = storage_path('/tmp/pdf/');
    }

    public function build() {
        $email = $this->view('Emails.Bandung.SendInvoiceTeam', $this->data)
          ->subject('Pembayaran Dari Profit Share');

        foreach($this->data['files'] as $file){
          $email->attach($file);
        }

        return $email;
    }
}
