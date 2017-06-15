<?php

namespace App\Http\Controllers\Admin_boleteria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Boleteria\Serial;
use App\Model\Boleteria\Asignacion;

use Auth;

class CoordinadorController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $seriales  = Serial::all()->where('admin_user_id', '=' , Auth::guard('admin_user')->user()->id)->where('estado_actual_id','!=',5);
      return view('adminlte::admin_boleteria.coordinador.coordinador',[ 'seriales' => $seriales]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function aprobar($id)
  {
     $serial = Serial::where('admin_user_id', '=' , Auth::guard('admin_user')->user()->id)->where('id',$id)->first();
     $serial->estado_actual_id = 1;
     $serial->save();

     $asignacion = new Asignacion();
     $asignacion->admin_user_id = Auth::guard('admin_user')->user()->id;
     $asignacion->serial_id = $serial->id;
     $asignacion->estado_id = 1;
     $asignacion->save();

     return redirect('admin_boleteria/coordinador');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function negar($id)
  {
    $serial = Serial::where('admin_user_id', '=' , Auth::guard('admin_user')->user()->id)->where('id',$id)->first();
    $serial->estado_actual_id = 2;
    $serial->save();

    $asignacion = new Asignacion();
    $asignacion->admin_user_id = Auth::guard('admin_user')->user()->id;
    $asignacion->serial_id = $serial->id;
    $asignacion->estado_id = 2;
    $asignacion->save();

    return redirect('admin_boleteria/coordinador');

  }
}
