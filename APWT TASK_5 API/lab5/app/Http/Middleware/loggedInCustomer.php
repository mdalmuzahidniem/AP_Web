<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class loggedInCustomer
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
        if(session()->has('userId'))
        {
            return $next($request);
        }
        return redirect()->route('needLogin');
    }
}
