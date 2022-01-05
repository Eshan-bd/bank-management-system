<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminValidCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->session()->get('adminid')){
            
            return $next($request);
        }

         return redirect()->route('home.login');
    }
}
