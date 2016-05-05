<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Redirect;
use Closure;
use Illuminate\Support\Facades\Session;

class LoginCheck
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
        if(!Session::has('userId') && !Session::has('redirect')) {
            Session::put('redirect', 1);
            return redirect('signInIndex');
        } else {
            Session::forget('redirect');
        }
        return $next($request);
    }
}
