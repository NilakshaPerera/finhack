<?php

namespace App\Http\Middleware;

use App\Setting;
use Closure;
use Auth;

class IsStudent{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if (Auth::user() && Auth::user()->role_id == 2) {
            return $next($request);
        }
        elseif(Auth::user() && Auth::user()->role_id == 3){
            return redirect('/admin/exams');
        }
        elseif(Auth::user() && Auth::user()->role_id == 1){
            return redirect('/admin/user');
        }
        abort(404);
    }

}
