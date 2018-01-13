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
use Exception;


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
      /*
       $this->Validate($request,['cedula' => 'required|']);
       $cedula = $request->cedula;

       $usuario = Users_detalle::where('cedula',$cedula)->first();

       if (!$usuario) {

         $url_datos = "http://190.145.4.62/WebServices/WSEstadoCuenta.asmx/ConsultarDatoBasicosPersona?pEntidad=FONSODI&pIdentificador=".$request->cedula."&pTipo=Identificacion";
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
       */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      /*

      $this->Validate($request,[
          'cuotas' => 'required|numeric|min:1|max:6',
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
      */
    }

    public function vender()
    {
      $seriales  = Serial::all()->where('admin_user_id',Auth::guard('admin_user')->user()->id)->where('estado_actual_id','!=',5)->where('estado_actual_id','!=',2)->where('estado_actual_id','!=',3);
      $productos  = Producto::all();
      return view('adminlte::admin_boleteria.venta.catalogo',[ 'seriales' => $seriales, 'productos' => $productos ]);
    }

    public function venderProducto($id)
    {
      $producto = Producto::find($id);
      $seriales  = Serial::where('producto_id',$id)->where('admin_user_id',Auth::guard('admin_user')->user()->id)->where('estado_actual_id',1)->get();
      return view('adminlte::admin_boleteria.venta.add',[ 'seriales' => $seriales, 'producto' => $producto]);
    }

    public function asociadoCedula($cedula)
    {
        $asociado = Users_detalle::where('cedula',$cedula)->first();

        if ($asociado) {
          return response()->json(['nombre' => $asociado->usuario->name, 'codigo' => $asociado->cod_persona, 'id' => $asociado->usuario->id]);
        }else {

          $url_datos = "http://190.145.4.62/WebServices/WSEstadoCuenta.asmx/ConsultarDatoBasicosPersona?pEntidad=FONSODI&pIdentificador=".$cedula."&pTipo=Identificacion";
          $response_xml_datos = file_get_contents($url_datos);
          $xml_datos = simplexml_load_string($response_xml_datos);

          if ($xml_datos->result == 'true') {

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
          $users_detalle->save();

          $telefono = new Telefono;
          $telefono->user_id = $iduser;
          $telefono->tipo = 'telefono';
          $telefono->numero = $xml_datos->telefono;
          $telefono->save();

          $usuario = Users_detalle::where('cedula',$cedula)->first();

          return response()->json(['nombre' => $usuario->usuario->name, 'codigo' => $usuario->cod_persona, 'id' => $usuario->usuario->id]);
          }
          else {
            return response()->json(['asociado' => 'No encontrado']);
          }

        }
    }

    public function servicio(Request $request, $idProducto)
    {
      $this->Validate($request,[
          'cuotas' => 'required|numeric|min:1|max:6',
          'serial' => 'required|',
          'cedula' => 'required|numeric',
          'codigo' => 'required|numeric',
          'idAsociado' => 'required|numeric',
      ]);

      $producto = Producto::find($idProducto);

      $serieTotalValor = 0;
      $serieTotalCompra = 0;
      $serieTotalPublico = 0;
      $seriales = $request->serial;

      foreach ($seriales as $serie) {
        $serialDatos = Serial::find($serie);
        $serieTotalValor = $serieTotalValor+$serialDatos->precio_venta;
        $serieTotalCompra = $serieTotalCompra+$serialDatos->precio_compra;
        $serieTotalPublico = $serieTotalPublico+$serialDatos->precio_publico;
      }

      $beneficio = $serieTotalPublico-$serieTotalValor;

      $urlServicio ="http://190.145.4.62/WebServices/WSCredito.asmx/CrearServicioDesembolso?pEntidad=FONSODI&pIdentificacion=".$request->cedula."&pCod_linea_servicio=".$producto->producto_provedor->codigo."&pValorTotal=".$serieTotalValor."&pNumeroCuotas=".$request->cuotas."&pPeriodicidad=1&pForma_pago=2&pVr_compra=".$serieTotalCompra."&pVr_beneficio=".$beneficio."&pVr_Mercado=".$serieTotalPublico;

      try {
         $servicio = file_get_contents($urlServicio);
       } catch (Exception $e) {
         session()->flash('message', 'No se procesó la compra');
         return redirect('admin_boleteria/vender/add/'.$idProducto);
       }

       $servicio = simplexml_load_string($servicio);

       if ($servicio->esCorrecto == "true") {

         $referencia = str_random(6).'-'.$request->cedula;

         $venta = new Venta();
         $signacion = new Asignacion;
         $serial_update = new Serial;

         $venta->user_id = $request->idAsociado;
         $venta->admin_user_id = Auth::guard('admin_user')->user()->id;
         $venta->cuota = $request->cuotas;
         $venta->referencia = $referencia;
         $venta->radicado = $servicio->numero_servicio;
         $venta->save();
         $idventa = $venta->id;

         $fecha_created_at = Carbon::now();

         foreach ($seriales as $serial) {

           DB::table('venta_detalles')->insert(
               [
                 'venta_id' => $idventa,
                 'serial_id' =>  $serial,
                 'referencia' =>  $referencia,
               ]
           );

           DB::table('asignaciones')->insert(
               [
                 'admin_user_id' => Auth::guard('admin_user')->user()->id,
                 'serial_id' =>  $serial,
                 'estado_id' => 5,
                 'created_at' =>  $fecha_created_at,
               ]
           );

           DB::table('seriales')->where('id', $serial)->update(
               [
                 'estado_actual_id'  => 5,
                 'updated_at'    => $fecha_created_at,
               ]
           );
         }

         session()->flash('message', 'Compra realizada correctamente');
         return redirect('admin_boleteria/vender');

       }else {
         session()->flash('message', 'No se procesó la compra');
         return redirect('admin_boleteria/vender/add/'.$idProducto);
       }



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Boleteria\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function credito(Request $request, $idProducto)
    {
      $this->Validate($request,[
          'cuotas' => 'required|numeric|min:1|max:6',
          'serial' => 'required|',
          'cedula' => 'required|numeric',
          'codigo' => 'required|numeric',
          'idAsociado' => 'required|numeric',
      ]);

      $producto = Producto::find($idProducto);

      $serieTotalValor = 0;
      $serieTotalCompra = 0;
      $serieTotalPublico = 0;
      $seriales = $request->serial;

      foreach ($seriales as $serie) {
        $serialDatos = Serial::find($serie);
        $serieTotalValor = $serieTotalValor+$serialDatos->precio_venta;
        $serieTotalCompra = $serieTotalCompra+$serialDatos->precio_compra;
        $serieTotalPublico = $serieTotalPublico+$serialDatos->precio_publico;

      }

      $beneficio = $serieTotalPublico-$serieTotalValor;

       $urlCredito = "http://190.145.4.62/WebServices/WSAppFinancial.asmx/GrabarCredito?pEntidad=FONSODI&pCod_Persona=".$request->codigo."&pMontoSoli=".$serieTotalValor."&pPlazo=".$request->cuotas."&pTipoCredito=8&pPeriodicidad=1&pDestino=".$producto->producto_provedor->codigo."&pFormaPago=2&pEmpresa=1&pCod_Oficina=1&pObservacion=&pVr_compra=".$serieTotalCompra."&pVr_beneficio=".$beneficio."&pVr_Mercado=".$serieTotalPublico."&pIdentProveedor=".$producto->producto_provedor->nit;

       try {
         $credito = file_get_contents($urlCredito);
       } catch (Exception $e) {
         session()->flash('message', 'No se procesó la compra');
         return redirect('admin_boleteria/vender/add/'.$idProducto);
       } 

       $credito = simplexml_load_string($credito);


       if ($credito->esCorrecto == "true") {

         $referencia = str_random(6).'-'.$request->cedula;

         $venta = new Venta();
         $signacion = new Asignacion;
         $serial_update = new Serial;

         $venta->user_id = $request->idAsociado;
         $venta->admin_user_id = Auth::guard('admin_user')->user()->id;
         $venta->cuota = $request->cuotas;
         $venta->referencia = $referencia;
         $venta->radicado = $credito->numero_radicacion;//numero de radicacion
         $venta->save();
         $idventa = $venta->id;

         $fecha_created_at = Carbon::now();

         foreach ($seriales as $serial) {

           DB::table('venta_detalles')->insert(
               [
                 'venta_id' => $idventa,
                 'serial_id' =>  $serial,
                 'referencia' =>  $referencia,
               ]
           );

           DB::table('asignaciones')->insert(
               [
                 'admin_user_id' => Auth::guard('admin_user')->user()->id,
                 'serial_id' =>  $serial,
                 'estado_id' => 5,
                 'created_at' =>  $fecha_created_at,
               ]
           );

           DB::table('seriales')->where('id', $serial)->update(
               [
                 'estado_actual_id'  => 5,
                 'updated_at'    => $fecha_created_at,
               ]
           );
         }

         session()->flash('message', 'Compra realizada correctamente');
         return redirect('admin_boleteria/vender');

       }else {
         session()->flash('message', 'No se procesó la compra');
         return redirect('admin_boleteria/vender/add/'.$idProducto);
       }

 
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
