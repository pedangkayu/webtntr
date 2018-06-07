<?php

namespace App\Jobs\Setting\Header;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\data_image_header;

class EditeHeaderJob implements ShouldQueue {

    use InteractsWithQueue, Queueable, SerializesModels;

    public $req;

    public function __construct($req) {
        $this->req = $req;
    }

    public function handle() {
      try {
        \DB::begintransaction();
        $id = $this->req['id'];
        unset($this->req['_token']);
        unset($this->req['id']);
        unset($this->req['PUT']);
        data_image_header::find($id)->update($this->req);
        \DB::commit();
        session()->flash('notif', [
            'label' => 'success',
            'err' => 'Header was Updated'
        ]);
      } catch (\Exception $e) {
        \DB::rollback();
        session()->flash('notif', [
            'label' => 'danger',
            'err' => $e->getMessage()
        ]);
      }

    }
}
