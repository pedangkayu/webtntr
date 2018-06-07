<?php

namespace App\Jobs\Merchant\Schedule;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\data_schedule;

class EditeScheduleJob implements ShouldQueue {

    use InteractsWithQueue, Queueable, SerializesModels;

    public $req;

    public function __construct($req) {
        $this->req = $req;
    }

    public function handle() {

        try {
          \DB::begintransaction();
            $data = $this->req;
            $id = $this->req['id'];
            $data['time_start'] = $this->req['date_start']  . ' ' . $this->req['waktu_start'];
			$data['time_end'] = $this->req['date_end']  . ' ' . $this->req['waktu_end'];
				unset($data['_token']);
				unset($data['_method']);
				unset($data['date_start']);
				unset($data['date_end']);
				unset($data['waktu_start']);
				unset($data['waktu_end']);
				unset($data['id']);
            
            data_schedule::find($id)->update($data);
          \DB::commit();
          session()->flash('notif', [
              'label' => 'success',
              'err' => 'Schedule was saved'
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
