<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Coordinador
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
        /**
         * Middleware para controlar el acceso de los provedores 
         * a la manipulacion de las lineas en la vista, restringiendo
         * el  CRUD solo al proveedor correspondiente
         */
         
      if (Auth::guard('admin_user')->user()->role_id > 13) {
         return redirect('error404');
      }
      return $next($request);
    }
}
