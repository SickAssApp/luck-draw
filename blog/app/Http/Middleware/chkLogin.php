<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Closure;
use Auth;

class chkLogin
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

        if(!isset(Auth::user()->email)){
            Log::channel('single')->error("chkLogin::handle User not login.");
            $request->session()->flush();
            return redirect('main');
        }

        return $next($request);
    }    
}
