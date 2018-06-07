<?php

namespace App\Listeners\Contact;

use Mail;

use App\Events\Contact\SendContactEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Mail\Contact\SendContactAdminMail;

class SendContactAdminListener {

    public function __construct() {

    }

    public function handle(SendContactEvent $event) {

      Mail::to($event->data['config']['email'])->send(new SendContactAdminMail($event->data));

    }
}
