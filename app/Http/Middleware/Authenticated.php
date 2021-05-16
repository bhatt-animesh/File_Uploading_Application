<?php

namespace App\Http\Middleware;

use Closure;

class Authenticated
{
    public function handle($request, Closure $next)
    {
        if(!empty(auth()->user()->role_id)){
            if(auth()->user()->role_id == 1){
                return $next($request);
            } else if(auth()->user()->role_id == 2){
                return $next($request);
            }
            return redirect('/login')->with('error', "CompanyID And Password Dose Not Match");
        }
        return redirect('/login')->with('error', "You have no proper authentication to access the area!");
            
    }
}