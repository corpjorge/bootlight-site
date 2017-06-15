<?php

namespace App\Http\Controllers\Admin_Boleteria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Boleteria\Venta;
use App\Model\Boleteria\Venta_detalle;
use App\Model\Usuario\Users_detalle;
use App\Model\Boleteria\Serial;
use App\Model\Boleteria\Producto;
use App\Model\Boleteria\Asignacion;
use App\Model\Usuario\Telefono;
use App\User;

use DB;
use \Carbon\Carbon;
use Auth;


class VenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $date = new Carbon('yesterday');
      $dat = new Carbon('tomorrow');
      $ventas  = Venta::orderBy('id','desc')->where('created_at', '>' ,$date)
                                            ->where('created_at', '<' ,$dat)
                                            ->where('admin_user_id',Auth::guard('admin_user')->user()->id)->get();

      return view('adminlte::admin_boleteria.venta.venta',[ 'ventas' => $ventas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       $this->Validate($request,['cedula' => 'required|']);
       $cedula = $request->cedula;

       $usuario = Users_detalle::where('cedula',$cedula)->first();

       if (!$usuario) {

         $url_datos = "http://50.63.15.92:420/WebServices/WSEstadoCuenta.asmx/ConsultarDatoBasicosPersona?pEntidad=FONSODI&pIdentificador=".$request->cedula."&pTipo=Identificacion";
         $response_xml_datos = file_get_contents($url_datos);
         $xml_datos = simplexml_load_string($response_xml_datos);

         if($xml_datos->result == 'true'){

           $user = new User;
           $user->name    = $xml_datos->primer_nombre.' '.$xml_datos->segundo_nombre.' '.$xml_datos->primer_apellido.' '.$xml_datos->segundo_apellido;
           $user->email   = $xml_datos->email;
           $user->social_name   = '';
           $user->social_id   = '';
           $user->avatar   = '';
           $user->password= bcrypt($xml_datos->clavesinencriptar);
           $user->role_id = 10;
           $user->save();
           $iduser = $user->id;

           $users_detalle = new Users_detalle;
           $users_detalle->user_id = $iduser;
           $users_detalle->cedula  = $xml_datos->identificacion;
           $users_detalle->cod_persona = $xml_datos->cod_persona;
           $users_detalle->fecha_nacimiento = $xml_datos->fecha_nacimiento;
           $users_detalle->almacen = '';
           $users_detalle->cuidad = $xml_datos->nomciudadresidencia;
           $users_detalle->genero = $xml_datos->genero;
           $users_detalle->direccion = $xml_datos->direccion;
           $users_detalle->estado_vinculacion = $xml_datos->estado;
           $users_detalle->estado_civil_id = $xml_datos->codestadocivil;
           $users_detalle->hobby = '';
           $users_detalle->save();

           $telefono = new Telefono;
           $telefono->user_id = $iduser;
           $telefono->tipo = 'telefono';
           $telefono->numero = $xml_datos->telefono;
           $telefono->save();

           $usuario = Users_detalle::where('cedula',$cedula)->first();
           $seriales  = Serial::all()->where('admin_user_id',Auth::guard('admin_user')->user()->id)->where('estado_actual_id','!=',5)->where('estado_actual_id','!=',2)->where('estado_actual_id','!=',3);
           $productos  = Producto::all();

           return view('adminlte::admin_boleteria.venta.add',[ 'usuario' => $usuario, 'seriales' => $seriales, 'productos' => $productos, ]);

         }
         else{
           session()->flash('error', 'Cedula no se encuentra');
           return redirect()->back();
         }

       }else{
         $seriales  = Serial::all()->where('admin_user_id',Auth::guard('admin_user')->user()->id)->where('estado_actual_id','!=',5)->where('estado_actual_id','!=',2)->where('estado_actual_id','!=',3);
         $productos  = Producto::all();
         return view('adminlte::admin_boleteria.venta.add',[ 'usuario' => $usuario, 'seriales' => $seriales, 'productos' => $productos, ]);
       }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $this->Validate($request,[
          'cuotas' => 'required|numeric',
          'serial' => 'required|',
          'usuario' => 'required|numeric',
          'cedula' => 'required|numeric',
      ]);


      $referencia = str_random(6).'-'.$request->cedula;

      $venta = new Venta();
      $signacion = new Asignacion;
      $serial_update = new Serial;

      $venta->user_id = $request->usuario;
      $venta->admin_user_id = Auth::guard('admin_user')->user()->id;
      $venta->cuota = $request->cuotas;
      $venta->referencia = $referencia;
      $venta->save();
      $idventa = $venta->id;

      $seriales=$request->serial;
      $fecha_created_at = Carbon::now();

      foreach ($seriales as $serials) {

        DB::table('venta_detalles')->insert(
            [
              'venta_id' => $idventa,
              'serial_id' =>  $serials,
              'referencia' =>  $referencia,
            ]
        );

        DB::table('asignaciones')->insert(
            [
              'admin_user_id' => Auth::guard('admin_user')->user()->id,
              'serial_id' =>  $serials,
              'estado_id' => 5,
              'created_at' =>  $fecha_created_at,
            ]
        );

        DB::table('seriales')->where('id', $serials)->update(
            [
              'estado_actual_id'  => 5,
              'updated_at'    => $fecha_created_at,
            ]
        );

      }
      session()->flash('message', 'Compra realizada correctamente');
      return redirect('admin_boleteria/vender');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $venta = Venta::find($id);
        $venta_detalles = Venta::find($id)->venta_detalle;
        $usuario = Users_detalle::where('user_id',$venta->user_id)->first();
        $telefonos = User::find($venta->user_id)->usuario_telefono->first();

        foreach ($venta_detalles as $venta_detalle) {
          $totales[] = $venta_detalle->producto->precio_venta;
          $totalpublicos[] = $venta_detalle->producto->precio_publico;

        }

        $total = array_sum($totales);
        $totalpublico = array_sum($totalpublicos);
        $ganancia = $totalpublico - $total;

        return view('adminlte::admin_boleteria.venta.ver',compact('venta','usuario','telefonos','total','ganancia' ),[ 'venta_detalles' => $venta_detalles]);
    }

    public function pdfadmin($id)
    {

      $venta = Venta::find($id);
      $venta_detalles = Venta::find($id)->venta_detalle;
      $usuario = Users_detalle::where('user_id',$venta->user_id)->first();
      $telefonos = User::find($venta->user_id)->usuario_telefono->first();

      foreach ($venta_detalles as $venta_detalle) {
        $totales[] = $venta_detalle->producto->precio_venta;
        $totalpublicos[] = $venta_detalle->producto->precio_publico;
      }
      $total = array_sum($totales);
      $totalpublico = array_sum($totalpublicos);
      $ganancia = $totalpublico - $total;
      return view('adminlte::admin_boleteria.venta.pdf',compact('venta','usuario','telefonos','total','ganancia'),[ 'venta_detalles' => $venta_detalles]);
/*
      $view =  \View::make('adminlte::admin_boleteria.venta.pdf',compact('venta','usuario','telefonos','total'),[ 'venta_detalles' => $venta_detalles]);

      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($view);
      return $pdf->download($venta->referencia.'.pdf');
*/

    }
}
