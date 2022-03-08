<?php

namespace App\Http\Middleware;
use App\Models\token;
use Closure;
use Illuminate\Http\Request;

class APIAuth
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
        $token=$request->header("Authorization");
        $check_token=token::where('token',$token)
                ->where('expired_at',NULL)
                ->first();
        if($check_token){
            return $next($request);
        }
        else{
            return response("invalid token",401);
        }
        
    }
}
