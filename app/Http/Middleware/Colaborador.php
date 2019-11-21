<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Colaborador
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
      if (Auth::user()->role_id > 11) {
         return redirect('noasicado');
      }
      return $next($request);
    }
}
