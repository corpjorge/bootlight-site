<?php

namespace App\Http\Controllers\Usuario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Usuario\Users_detalle;
use Auth;

class Users_detalleController extends Controller
{
      /**
       * Show the application dashboard.
       *
       * @return Response
       */
       public function index()
       {
           $users_detalles  = Users_detalle::all()->where('user_id', Auth::user()->id);
           return view('adminlte::usuario.perfil',[ 'users_detalles' => $users_detalles]);

       }

       /**
        * Show the application dashboard.
        *
        * @return Response
        */
        public function datos($id)
        {
            $users_detalles = Users_detalle::where('id',$id)->first();
            return view('adminlte::usuario.datos',[ 'users_detalles' => $users_detalles]);

        }

        public function help()
        {
          return view('adminlte::usuario.help.help');
        }
}
