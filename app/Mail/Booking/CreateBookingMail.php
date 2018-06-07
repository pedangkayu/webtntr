<?php

namespace App\Mail\Booking;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateBookingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data) {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->view('Emails.Booking.CreateBooking', $this->data)
          ->subject($this->data['spa'] . ' - #' . $this->data['code']);
    }
}
