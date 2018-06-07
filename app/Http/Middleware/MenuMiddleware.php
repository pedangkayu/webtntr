<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\navigasi;
use App\Models\akses_navigasi;
use Carbon\Carbon;
use Caffeinated\Menus\Builder;
use App\Models\posts;

class MenuMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if(\Auth::check()): // Jika Login

            $navs = akses_navigasi::menus()->get();
            $menus = [];
            foreach($navs as $nav){
                $menus[$nav->parent_id][] = $nav;
            }

            \Menu::make('main', function(Builder $menu) use ($menus) {
                if(!empty($menus[0])): // Jika ada menu
                    foreach($menus[0] as $nav):
                        $navigasi = $menu->add($nav->title, $nav->slug)
                            ->attribute('data-id', $nav->id)
                            ->attribute('data-menuid', $nav->id)
                            ->attribute('id', $nav->class_id)
                            ->attribute('class', $nav->class)
                            ->attribute('title', $nav->ket)
                            ->data('navigasi_id', $nav->id)
                            ->icon($nav->icon, '')
                            ->active($nav->slug);

                        if(!empty($menus[$nav->id])){ // Jika ada anak menu
                            foreach($menus[$nav->id] as $cld):
                                    $anak = $navigasi->add($cld->title, $cld->slug)
                                        ->attribute('data-id', $cld->id)
                                        ->attribute('id', $cld->class_id)
                                        ->attribute('class', $cld->class)
                                        ->attribute('title', $cld->ket)
                                        ->data('navigasi_id', $cld->id)
                                        ->icon($cld->icon, '')
                                        ->active($cld->slug);


                                        if(!empty($menus[$cld->id])){ // Jika ada cucu menu
                                            foreach($menus[$cld->id] as $cucu):
                                                    $anak->add($cucu->title, $cucu->slug)
                                                        ->attribute('data-id', $cucu->id)
                                                        ->attribute('id', $cucu->class_id)
                                                        ->attribute('class', $cucu->class)
                                                        ->attribute('title', $cucu->ket)
                                                        ->data('navigasi_id', $cucu->id)
                                                        ->icon($cucu->icon, '')
                                                        ->active($cucu->slug);;
                                            endforeach;
                                        }

                            endforeach;
                        }

                    endforeach;
                endif;


            });
        endif;

        // Menu Front end
        /*\Menu::make('mainmenu', function(Builder $menu){
          $menu->add('Home', url('/'));
          $menu->add('All Spa', url('/page/spa'));
          $menu->add('Service & Package', url('/page/servicepack'));
          $menu->add('Blog', 'http://blog.paladin.net')->attribute('target', '_blank');
          $menu->add('Contact Us', url('/page/contactus'));
        });

        // TOp Menu
        \Menu::make('topmenu', function(Builder $menu){
          $menu->add('About Us', url('/page/aboutus'));
          $menu->add('Terms & Condition', url('/page/terms-condition'));
        }); */

        $this->expireSchedule();
        
        return $next($request);
    }

    public function expireSchedule()
    {
        $dateNow = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $jadwal = posts::where('type', 2)->where('status', 1)->where('date_schedule_end', '<', $dateNow)->get();
        if (count($jadwal)) {
            foreach ($jadwal as $key => $value) {
                posts::where('id', $value->id)->update(['status' => 0]);
            }
        }
    }
}
