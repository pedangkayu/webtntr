<?php

namespace App\Jobs\Spa\Schedule;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\data_schedule;

class CreateScheduleJob implements ShouldQueue {

    use InteractsWithQueue, Queueable, SerializesModels;

    public $req;

    public function __construct($req) {
        $this->req = $req;
    }

    public function handle() {

        try {
          $slug = str_slug($this->req['nm_schedule']);
          $count = data_schedule::where(\DB::raw('LOWER(nm_schedule)'), strtolower($this->req['nm_schedule']))->count();
          \DB::begintransaction();
            $data = $this->req;
            $data['time_start'] = $this->req['date_start']  . ' ' . $this->req['waktu_start'];
			      $data['time_end'] = $this->req['date_end']  . ' ' . $this->req['waktu_end'];
            $data['user_id'] = \Auth::user()->id;
            $data['slug'] = $count > 0 ? $slug . '-' . $count : $slug;
            unset($data['_token']);
            unset($data['date_start']);
            unset($data['date_end']);
            unset($data['waktu_start']);
            unset($data['waktu_end']);
            data_schedule::create($data);
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
