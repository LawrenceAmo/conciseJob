<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;


use Closure;

class Role
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
        // if(Auth::User()->roleID === 2){
        //     return redirect()->to('/admin');
        // }
        // if(Auth::User()->roleID === 4){
        //     return redirect()->to('/portal');
        // }
        return $next($request);
        //return redirect()->back();
    }
}
