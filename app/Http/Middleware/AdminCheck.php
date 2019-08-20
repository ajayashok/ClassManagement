<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminCheck
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
       if(Auth::check())
        {
            if(!((Auth::User()->user_type == "student")||(Auth::User()->user_type == "teacher")))
            {
                return $next($request);
            }
            else
            {
                return redirect()->route('home'); 
            }
        }
        else
        {
                return redirect()->route('login');            
        }
        return $next($request);
    }
}
