<?php

namespace App\Events\PayPal;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PayPalNotificationSuccessPaymantEvent
{
    use InteractsWithSockets, SerializesModels;

    public $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function broadcastOn() {
      return new PrivateChannel('channel-name');
    }
}
