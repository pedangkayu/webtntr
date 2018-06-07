<?php

namespace App\Jobs\Merchant;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\data_merchant;

class CreateItemJob implements ShouldQueue {
    use InteractsWithQueue, Queueable, SerializesModels;

    public $req;

    public function __construct(array $req) {
        $this->req = $req;
    }

    public function handle() {
      $data_merchant = $this->req;
      $data_merchant['template_id'] = 1;
      unset($data_merchant['_token']);
      try {
        \DB::begintransaction();
        $item = data_merchant::create($data_item);
        \DB::commit();
        session()->flash('notif', [
            'id' => $merchant->id_merchant,
            'label' => 'success',
            'err' => $data_merchant['merchant'] . ' was saved'
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
