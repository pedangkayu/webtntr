<?php

namespace App\Listeners\PayPal;

use Mail;

use App\Events\PayPal\PayPalNotificationSuccessPaymantEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Mail\PayPal\SendSuccessToAdminMail;

class SendNotificationSuccessAdminListener {

  public function __construct() {

  }

  public function handle(PayPalNotificationSuccessPaymantEvent $event) {
    $to = $event->data['config']->bcc_booking_email;
    Mail::to($to)
      ->bcc([$event->data['config']->email])
      ->send(new SendSuccessToAdminMail($event->data));
  }
}
