<?php

namespace App\Jobs\Merchant;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\data_merchant;

class EditMerchantJobs implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $req;

    public function __construct(array $req) {
        $this->req = $req;
    }

    public function handle() {
      $data_merchant = $this->req;
      unset($data_spa['_token']);
      unset($data_spa['_method']);
      unset($data_spa['id']);
      unset($data_spa['slug_old']);
      try {
        \DB::begintransaction();
        data_merchant::find($this->req['id'])->update($data_merchant);
        \DB::commit();
        session()->flash('notif', [
            'label' => 'success',
            'err' => $data_Merchant['Merchant'] . ' was updated'
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
