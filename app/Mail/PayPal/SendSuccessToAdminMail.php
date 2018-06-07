<?php

namespace App\Mail\PayPal;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSuccessToAdminMail extends Mailable
{
  use Queueable, SerializesModels;
  public $data;
  public function __construct($data) {
      $this->data = $data;
  }
  public function build() {
    $data = $this->data->toArray();
    return $this->view('Emails.PayPal.SuccessPaymentAdmin', $data)
      ->subject('Payment Success - #' . $this->data->code);
  }
}
