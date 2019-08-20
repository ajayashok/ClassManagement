<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

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
         if(Auth::check()){
                if(Auth::check() && (Auth::User()->user_type == "student"))
                {
                return redirect()->route('student.index'); 
                }
                else if(Auth::check() && Auth::User()->user_type =="admin")
                {
                 return redirect()->route('admin.index'); 
                }
                else if(Auth::check() && Auth::User()->user_type == "teacher")
                {
                 return redirect()->route('teacher.index'); 
                }       
                else
                {
                  return $next($request);
                }
            }else
            {
               return redirect()->route('login');            
            }
    }
}
