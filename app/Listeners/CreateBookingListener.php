<?php

namespace App\Listeners;

use Mail;

use App\Events\Booking\CreateBookingEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Mail\Booking\CreateBookingMail;

class CreateBookingListener {

    public function __construct() {}

    public function handle(CreateBookingEvent $event) {
      $data = $event->data;

      if($data['premium'] > 0)
        $bcc[] = $data['spa_email'];

      $bcc[] = $data['config']['bcc_booking_email'];
      $bcc[] = $data['config']['email'];

      Mail::to($data['email'])
        ->bcc($bcc)
        ->send(new CreateBookingMail($data));
    }
}
