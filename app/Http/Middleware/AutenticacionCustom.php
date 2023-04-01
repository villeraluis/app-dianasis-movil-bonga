<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AutenticacionCustom
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
       
             $ac=$next($request);
            
              if($request->session()->has('idUsuario')){
               
                return $ac ;
               
              }else{
                return redirect()->route('login');
              }
             
              

             
             
              
    }
}
