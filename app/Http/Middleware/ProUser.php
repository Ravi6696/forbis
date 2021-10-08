<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class ProUser
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
        if(Auth::check() && Auth::user()->hasRole('pro-user')){
            if(Auth::user()->trial_ends_at < date('Y-m-d')){
                return redirect('/become-pro-user');
            }
            return $next($request);
        }
        Auth::logout();
        return redirect('/');
    }
}
