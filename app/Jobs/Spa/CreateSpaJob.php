<?php

namespace App\Jobs\Spa;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\data_spa;

class CreateSpaJob implements ShouldQueue {
    use InteractsWithQueue, Queueable, SerializesModels;

    public $req;

    public function __construct(array $req) {
        $this->req = $req;
    }

    public function handle() {
      $data_spa = $this->req;
      $data_spa['template_id'] = 1;
      unset($data_spa['_token']);
      try {
        \DB::begintransaction();
        $spa = data_spa::create($data_spa);
        \DB::commit();
        session()->flash('notif', [
            'id' => $spa->id_spa,
            'label' => 'success',
            'err' => $data_spa['spa'] . ' was saved'
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
