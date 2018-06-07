<?php

namespace App\Jobs\Merchant;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\data_servicepack;

class EditServicePackJob implements ShouldQueue {
    use InteractsWithQueue, Queueable, SerializesModels;

    public $req;

    public function __construct(array $req) {
        $this->req = $req;
    }

    public function handle() {
      try {
        $type = [
          1 => 'Service',
          2 => 'Package'
        ];

        $data = $this->req;
        $id = $this->req['id'];
        unset($data['id']);
        unset($data['_token']);
        unset($data['_method']);
        unset($data['img_thumb']);
        \DB::begintransaction();
        $service = data_servicepack::find($id)->update($data);
        \DB::commit();
        session()->flash('notif', [
            'label' => 'success',
            'err' => $type[$data['type']] . ' was updated'
        ]);
      } catch (\Exception $e) {
        \DB::rollback();
        session()->flash('notif', [
            'id' => 0,
            'label' => 'danger',
            'err' => $e->getMessage()
        ]);
      }

    }
}
