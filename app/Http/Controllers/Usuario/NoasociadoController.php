<?php

namespace App\Http\Controllers\Usuario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoasociadoController extends Controller
{
  /**
   * Show the application dashboard.
   *
   * @return Response
   */
   public function index()
   {
       return view('adminlte::usuario.noasociado');
   }

   /**
    * Show the application dashboard.
    *
    * @return Response
    */
    public function error()
    {
        return view('adminlte::errors.404');
    }
}
