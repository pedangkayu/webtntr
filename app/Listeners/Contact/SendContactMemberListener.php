<?php

namespace App\Listeners\Contact;

use Mail;

use App\Events\Contact\SendContactEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Mail\Contact\SendContactMemberMail;

class SendContactMemberListener {

    public function __construct() {

    }

    public function handle(SendContactEvent $event) {
      if(!empty($event->data['premium'])){
          if($event->data['premium'] > 0){
            Mail::to($event->data['email'])->send(new SendContactMemberMail($event->data));
          }
      }
    }
}
