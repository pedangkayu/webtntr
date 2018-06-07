<?php

namespace App\Http\Middleware;

use App\User;
use App\Models\navigasi;
use App\Models\akses_navigasi;

use Closure;

class AccessPageMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if(\Auth::check()):

            // Online Checking
            $user = \Auth::User();
            $user->online = date('Y-m-d H:i:s', strtotime('+15 Minutes')); // Ditambahkan 15 Menit
            $user->save();

            $slugs = akses_navigasi::accesspage()->get();
            $akses = [];
            foreach($slugs as $slug){
                $akses[] = $slug->slug;
            }

            $count = navigasi::where('slug', $request->path())->count();
            if($count > 0 && !in_array($request->path(), $akses)){
                abort(404);
            }

        endif;

        return $next($request);
    }
}
