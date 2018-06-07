<?php

namespace App\Jobs\Front;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\data_message;

class MessageJob implements ShouldQueue {
    use InteractsWithQueue, Queueable, SerializesModels;

    public $req;

    public function __construct($req) {
      $this->req = $req;
    }

    public function handle() {
      $dat = [];
      try {
        \DB::begintransaction();
        $data['name']     = $this->req['from_name'];
        $data['email']    = $this->req['from_email'];
        $data['website']  = !empty($this->req['from_website']) ? $this->req['from_website'] : NULL;
        $data['subject']  = $this->req['subject'];
        $data['message']  = $this->req['from_message'];
        $data['spa_id']   = !empty($this->req['id_spa']) ? $this->req['id_spa'] : 0;
        $data['status']   = 1;
        data_message::create($data);
        \DB::commit();

      } catch (\Exception $e) {
        \DB::rollback();

      }


    }
}
