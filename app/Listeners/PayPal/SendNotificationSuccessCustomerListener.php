<?php

namespace App\Listeners\PayPal;

use Mail;

use App\Events\PayPal\PayPalNotificationSuccessPaymantEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Mail\PayPal\SendSuccessToCustomerMail;

class SendNotificationSuccessCustomerListener {

    public function __construct() {

    }

    public function handle(PayPalNotificationSuccessPaymantEvent $event) {
      $to = $event->data->email;
      Mail::to($to)->send(new SendSuccessToCustomerMail($event->data));
    }
}
