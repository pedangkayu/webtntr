<?php

namespace App\Jobs\Menus;

use App\Models\navigasi;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RepositionMenuJob implements ShouldQueue {
    
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
            $seri1 = 1;
            foreach($this->req['data'] as $i => $menu):

                $nav = navigasi::find($menu['id']);
                $nav->parent_id = 0;
                $nav->seri = $i;
                $nav->save();
                $seri1++;
                // Anak
                if(!empty($menu['children'])):

                    $seri2 = 1;
                    foreach($menu['children'] as $a => $anak):
                        $nav_anak = navigasi::find($anak['id']);
                        $nav_anak->parent_id = $menu['id'];
                        $nav_anak->seri = $a;
                        $nav_anak->save();

                        $seri2++;

                        // Cucu
                        if(!empty($anak['children'])):

                            $seri3 = 1;
                            foreach($anak['children'] as $b => $cucu):
                                $nav_cucu = navigasi::find($cucu['id']);
                                $nav_cucu->parent_id = $anak['id'];
                                $nav_cucu->seri = $b;
                                $nav_cucu->save();
                                $seri3++;
                            endforeach;
                        endif;

                    endforeach;
                endif;
                
            endforeach;

            \DB::commit();

            session()->flash('err',[
                'result' => true,
                'err' => 'Posisi berhasil tersimpan'
            ]);

        } catch (\Exception $e) {
            \DB::rollback();            
            session()->flash('err',[
                'result' => false,
                'err' => $e->getMessage()
            ]);
        }

    }
}
