<?php

namespace App\Jobs\Menus;

use App\Models\navigasi;
use App\Models\akses_navigasi;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class editMenuJob implements ShouldQueue
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
            
            unset($data['permission']);
            unset($data['_method']);
            unset($data['id']);
            unset($data['_token']);
            $nav = navigasi::find($this->req['id']);
            $nav->update($data);

            if(!empty($this->req['permission']) && count($this->req['permission']) > 0){
                akses_navigasi::where('navigasi_id', $this->req['id'])->delete();
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
                'err' => 'Berhasil diperbaharui'
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
