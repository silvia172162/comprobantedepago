<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use DB;

use Closure;
class CheckRoles
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
       $roles=array_slice(func_get_args(), 2);
       foreach ($roles as $rol) {
           if (Auth::user()->Rol==$rol && Auth::user()->Estado==1) {
             return $next($request);
             return redirect('/home');
           }else{
            Auth::logout();
            return redirect('/login');
           }          
       }

        
    }
}
