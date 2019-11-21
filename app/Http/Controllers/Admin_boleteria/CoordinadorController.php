<?php

namespace App\Http\Controllers\Admin_boleteria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Boleteria\Serial;
use App\Model\Boleteria\Asignacion;

use App\AdminUser;
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
      if (Auth::guard('admin_user')->user()->rol->id <= 6) {
         $useradmins  = AdminUser::all();
         return view('adminlte::admin_boleteria.coordinador-admin.coordinador', [ 'useradmins' => $useradmins]);
      }else {
        $seriales  = Serial::all()->where('admin_user_id', '=', Auth::guard('admin_user')->user()->id)->where('estado_actual_id', '!=', 5);
        return view('adminlte::admin_boleteria.coordinador.coordinador', [ 'seriales' => $seriales]);
      }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function aprobar(Request $request)
    {
        
        
        for ($i=0; $i < count($request->serial); $i++) { 
       
        $serial = Serial::where('admin_user_id', '=', Auth::guard('admin_user')->user()->id)->where('id', $request->serial[$i])->first();
        $serial->estado_actual_id = 1;
        $serial->save();

        $asignacion = new Asignacion();
        $asignacion->admin_user_id = Auth::guard('admin_user')->user()->id;
        $asignacion->serial_id = $request->serial[$i];
        $asignacion->estado_id = 1;
        $asignacion->save();
        }
      
        

        return redirect('admin_boleteria/coordinador');
         
    }

    public function aprobarTodos()
    {
                
        $seriales = Serial::where('admin_user_id', '=', Auth::guard('admin_user')->user()->id)->where('estado_actual_id',3)->get();

        foreach ($seriales as $serial) { 
            $serial->estado_actual_id = 1;
            $serial->save();

            $asignacion = new Asignacion();
            $asignacion->admin_user_id = Auth::guard('admin_user')->user()->id;
            $asignacion->serial_id = $serial->id;
            $asignacion->estado_id = 1;
            $asignacion->save();
 
        }
              
        return redirect('admin_boleteria/coordinador');
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function negar($id)
    {
        $serial = Serial::where('admin_user_id', '=', Auth::guard('admin_user')->user()->id)->where('id', $id)->first();
        $serial->estado_actual_id = 2;
        $serial->save();

        $asignacion = new Asignacion();
        $asignacion->admin_user_id = Auth::guard('admin_user')->user()->id;
        $asignacion->serial_id = $serial->id;
        $asignacion->estado_id = 2;
        $asignacion->save();

        return redirect('admin_boleteria/coordinador');
    }


    public function coordinadorshow($id)
    {
      $seriales  = Serial::all()->where('admin_user_id', '=', $id)->where('estado_actual_id', '!=', 5);
      return view('adminlte::admin_boleteria.coordinador-admin.add', [ 'seriales' => $seriales]);
    }



}
