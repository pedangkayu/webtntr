<?php

namespace App\Jobs\Menus;

use App\Models\navigasi;
use App\Models\akses_navigasi;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateMenuJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $req;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $req) {
        $this->req = $req;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        
        try {
            
            \DB::begintransaction();

            $data = $this->req;
            //dd($data);
            unset($data['permission']);
            unset($data['_token']);
            $nav = navigasi::create($data);

            if(!empty($this->req['permission']) && count($this->req['permission']) > 0){
                foreach($this->req['permission'] as $akses){
                    akses_navigasi::create([
                        'navigasi_id' => $nav->id,
                        'level_id' => $akses
                    ]);
                }
            }

            \DB::commit();

            session()->flash('notif', [
                'label' => 'success',
                'err' => 'Berhasil ditambahkan'
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
