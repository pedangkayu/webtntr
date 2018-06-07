<?php

namespace App\Jobs\Spa;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\data_servicepack;

class createServicepactJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $req;

    public function __construct(array $req) {
        $this->req = $req;
    }

    public function handle() {

      try {
        $slg = str_slug($this->req['servicepack']);
        $srv = data_servicepack::where(\DB::raw('LOWER(servicepack)'), strtolower($this->req['servicepack']))->count();
        $slug = $srv > 0 ? $slg . '-' .  $srv : $slg;
        $type = [
          1 => 'Service',
          2 => 'Package'
        ];

        $data = $this->req;
        $data['slug'] = $slug;
        unset($data['_token']);
        \DB::begintransaction();
        $service = data_servicepack::create($data);
        \DB::commit();
        session()->flash('notif', [
            'id' => $data['id_spa'],
            'label' => 'success',
            'err' => $type[$data['type']] . ' was saved'
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
