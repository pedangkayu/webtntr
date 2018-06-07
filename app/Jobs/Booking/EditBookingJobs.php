<?php

namespace App\Jobs\Booking;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\data_booking;

class EditSpaJobs implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $req;

    public function __construct(array $req) {
        $this->req = $req;
    }

    public function handle() {
      $data_booking = $this->req;
      unset($data_booking['_token']);
      unset($data_booking['_PUT']);
      unset($data_booking['id']);
      unset($data_booking['slug_old']);
      try {
        \DB::begintransaction();
        data_spa::find($this->req['id'])->update($data_booking);
        \DB::commit();
        session()->flash('notif', [
            'label' => 'success',
            'err' => $data_booking['booking'] . ' was updated'
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
