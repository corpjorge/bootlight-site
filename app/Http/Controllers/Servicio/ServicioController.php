<?php

namespace App\Http\Controllers\Servicio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Model\Sistema\Menu_users_sub;

class ServicioController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Response
     */
     public function index()
     {
         $menservis = Menu_users_sub::where('menu_user_id',5)->where('icono','!=','')->get();
         return view('adminlte::usuario.servicios.servicios',[ 'menservis' => $menservis]);
     }

     /**
      * Show the application dashboard.
      *
      * @return Response
      */
      public function cumple()
      {
          $menservis = Menu_users_sub::where('menu_user_id',5)->where('icono','!=','')->get();
          return view('adminlte::usuario.servicios.servicios',[ 'menservis' => $menservis]);
      }
}
