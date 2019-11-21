<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Asistente
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
      if (Auth::guard('admin_user')->user()->role_id > 9) {
         return redirect('error404');
      }
      return $next($request);
    }
}
