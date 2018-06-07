<?php

namespace App\Mail\Contact;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendContactMemberMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function build() {
      return $this->view('Emails.Contact.ForMember', $this->data)
        ->subject($this->data['subject']);
    }
}
