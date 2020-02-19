<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;

class GenerateDID
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        $did=session('did')??null;
//        if(!$did) {
//            session(['did'=>uniqid()]);
//        }
        $did=Cookie::get('did');
        if(!$did){
            Cookie::queue('did', uniqid(), 1440);
        }

        return $next($request);
    }
}
