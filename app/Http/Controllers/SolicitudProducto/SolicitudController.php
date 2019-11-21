<?php

namespace App\Http\Controllers\SolicitudProducto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\solicitudProducto\p_producto;
use App\Model\solicitudProducto\p_solicitud;
use App\Model\solicitudProducto\Consumo;
use App\Model\Usuario\Users_detalle;
use App\Model\Usuario\Polla;
use App\Mail\SolicitudProducto\Solicitud;
use App\Mail\SolicitudProducto\Negado;
use App\Mail\SolicitudProducto\Aprobado;
use App\Mail\SolicitudProducto\Desembolsar;

use App\Model\solicitudProducto\bancos;

use Maatwebsite\Excel\Facades\Excel;
use App\User;
use auth;
use Mail;
use DB;
use Carbon\Carbon;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = Users_detalle::where('user_id',Auth::user()->id)->first();
        $url_datos = "http://190.145.4.62/WebServices/WSEstadoCuenta.asmx/ConsultarDatoBasicosPersona?pEntidad=FONSODI&pIdentificador=".$usuario->cedula."&pTipo=Identificacion";
         $response_xml_datos = file_get_contents($url_datos);
         $xml_datos = simplexml_load_string($response_xml_datos);

        if ($xml_datos->email == '') {
          return view('adminlte::solicitud_producto.solicitud.negado');            
        }
        else{
          $rows = p_solicitud::where('user_id',Auth::user()->id)->orderBy('id', 'desc')->paginate(30);
          return view('adminlte::solicitud_producto.solicitud.index', [ 'rows' => $rows]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $usuario = Users_detalle::where('user_id',Auth::user()->id)->first();
        
        $url_datos = "http://190.145.4.62/WebServices/WSEstadoCuenta.asmx/ConsultarDatoBasicosPersona?pEntidad=FONSODI&pIdentificador=".$usuario->cedula."&pTipo=Identificacion";
         $response_xml_datos = file_get_contents($url_datos);
         $xml_datos = simplexml_load_string($response_xml_datos);

        if ($xml_datos->email == '') {
          return view('adminlte::solicitud_producto.solicitud.negado');            
        }
        else{
          $rows = p_producto::where('estados_id',1)->where('cuota_min','!=',0)->get();
          $banks = DB::table('banks')->get(); 
          
          return view('adminlte::solicitud_producto.solicitud.create', compact('usuario', 'banks', 'rows'));
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
            'producto' => 'required|',
            'monto' => 'required|',
            'cuota' => 'required|',
            'file' => 'required|',
            'celular' => 'required|',
            'cedula' => 'required|',
            'cod_asociado' => 'required|',
            //'account_type' => 'required|',
            //'account' => 'required|',
            //'is_principal' => 'required|',
            //'bank_id' => 'required|'
        ]); 
        
        //dd($request->all());
        
        $file = $request->file('file');
        $nombre = str_random(40);
        $fileType=$file->guessExtension();        
        \Storage::disk('local')->put($nombre,  \File::get($file));
         $ubicacion = 'subidas/productos/'.$nombre.'.'.$fileType;
        \Storage::move($nombre, $ubicacion);
        
         DB::BeginTransaction();
 
        $dato = new p_solicitud;
        $dato->user_id = Auth::user()->id;
        $dato->p_productos_id  = $request->producto;
        $dato->estados_id  = 3;
        $dato->cod_asociado  = $request->cod_asociado;
        $dato->cedula  = $request->cedula;
        $dato->celular  = $request->celular;
        $dato->monto  = $request->monto;
        $dato->cuotas  = $request->cuota;
        $dato->taza  = 0;
        $dato->codigo  = str_random(7);
        $dato->img  = $nombre.'.'.$fileType;      
        $dato->obs  = $request->observaciones;
        $dato->observacion  = 'Pendiente por revisión';
        $dato->pendiente  = Carbon::now();
        
        $dato->account_type = $request->account_type;
        $dato->account = $request->account;
        $dato->opening = Carbon::now();
        $dato->is_principal = true;
        $dato->bank_id = $request->bank_id;
        $dato->save();
        
        \Log::info('dato');
        \Log::info($dato);
        $url_datos = "http://190.145.4.62/WebServices/WSEstadoCuenta.asmx/ConsultarDatoBasicosPersona?pEntidad=FONSODI&pIdentificador=".$request->cedula."&pTipo=Identificacion";
        $response_xml_datos = file_get_contents($url_datos);
        \Log::info('dato 2');
        \Log::info($response_xml_datos);
        $xml_datos = simplexml_load_string($response_xml_datos);
        \Log::info('dato 3');
        \Log::info($xml_datos);  
        $email = (string)$xml_datos->email; 
        \Log::info('dato 4');
        \Log::info($email);  
        //$email = 'corpjorge@hotmail.com';
        Mail::send(new Solicitud($email,$dato));
        
        DB::commit();
         
        session()->flash('message', 'Guardado correctamente');
        return redirect()->route('solicitud.index'); 
    }

    public function solicitudes()
    {
        
      if (Auth::guard('admin_user')->user()->rol->id == 8) {
        $rows = p_solicitud::where('p_productos_id',Auth::guard('admin_user')->user()->ciudad)->where('estados_id',6)->get();
        return view('adminlte::solicitud_producto.solicitud.proveedor.desembolso', ['rows' => $rows ]);
      }else{
        $pendientes = p_solicitud::where('estados_id',3)->count();
        $aprobado = p_solicitud::where('estados_id', 1)->count();
        $negados = p_solicitud::where('estados_id',2)->count();
        
        $desembolsados_creditos = DB::table('p_solicitudes as s')
                    ->join('p_productos as p', 'p.id', '=', 's.p_productos_id')
                    ->join('users as u', 'u.id', '=', 's.user_id')
                    ->select('s.*', 'u.name as usuario', 'p.name as producto')
                    ->where('s.estados_id', 6)
                    ->where('p.tipo', '=', 1)
                    ->count();
                    
        $desembolsados_servicios = DB::table('p_solicitudes as s')
        ->join('p_productos as p', 'p.id', '=', 's.p_productos_id')
        ->join('users as u', 'u.id', '=', 's.user_id')
        ->select('s.*', 'u.name as usuario', 'p.name as producto')
        ->where('s.estados_id', 6)
        ->where('p.tipo', '=', 2)
        ->count();
        
        //$desembolsados = p_solicitud::where('estados_id',6)->count();
        $vendidos = p_solicitud::where('estados_id',5)->count();
        
      
        return view('adminlte::solicitud_producto.solicitud.solicitudes', compact('pendientes','aprobado','negados','desembolsados_creditos','desembolsados_servicios','vendidos')); 
      }        
    }

    public function solicitudesShow($id)
    { 
       
        if ($id == 6) {
           $rows = DB::table('p_solicitudes as s')
                    ->join('p_productos as p', 'p.id', '=', 's.p_productos_id')
                    ->join('users as u', 'u.id', '=', 's.user_id')
                    ->select('s.*', 'u.name as usuario', 'p.name as producto')
                    ->where('s.estados_id',$id)
                    ->where('p.tipo', '=', 1)
                    ->orderBy('id', 'desc')
                    ->get();
                    //dd($rows);
           return view('adminlte::solicitud_producto.solicitud.desembolsados', [ 'rows' => $rows]); 
        }elseif($id == 7){
            $rows = DB::table('p_solicitudes as s')
                    ->join('p_productos as p', 'p.id', '=', 's.p_productos_id')
                    ->join('users as u', 'u.id', '=', 's.user_id')
                    ->select('s.*', 'u.name as usuario', 'p.name as producto')
                    ->where('s.estados_id', '=', 6)
                    ->where('p.tipo', '=', 2)
                    ->orderBy('id', 'desc')
                    ->get();
                    //dd($rows);
           return view('adminlte::solicitud_producto.solicitud.desembolsados', [ 'rows' => $rows]); 
        }elseif($id == 1){
            $rows = p_solicitud::where('estados_id', $id)->where('aprobado', '<=', 'close')->orderBy('id', 'desc')->paginate(10);
            return view('adminlte::solicitud_producto.solicitud.show', compact('id'), [ 'rows' => $rows]);
        }else{
            $rows = p_solicitud::where('estados_id',$id)->orderBy('id', 'desc')->paginate(10);
            return view('adminlte::solicitud_producto.solicitud.show', compact('id'), [ 'rows' => $rows]);
        } 
    }

    public function codigo(Request $request, $id)
    {       
      $row = p_solicitud::find($id);     
      if ($row->codigo == $request->codigo) {
        $row->estados_id = 6;
        $row->desembolsado  = Carbon::now();
        $row->save();
        session()->flash('message', 'Guardado correctamente');
        return redirect('solicitud/productos');
      }
      else{
        session()->flash('error', 'codigo invalido');
        return redirect('solicitud/productos');
      }
       
    }

    public function aprobar(Request $request)
    {    
        $date = date('Y-m-d', strtotime('20 day'));
        
          for ($i=0; $i < count($request->solicitud); $i++) {     
            $solicitudes = p_solicitud::find($request->solicitud[$i]);
            $solicitudes->estados_id = 5;
            $solicitudes->close = $date;
            $solicitudes->save(); 
          }
          session()->flash('message', 'Guardado correctamente');
          return redirect('solicitudes/solicitados/6');
    }


    public function excel()
    {
        $solicitudes = p_solicitud::where('taza',0)->get();
        $creditos = array();
        $servicios = array();

        foreach ($solicitudes as $solicitud) {

          if ($solicitud->estados_id  == 1) 
          {
              $est = "Aprobado";
          }
          elseif ($solicitud->estados_id  == 2) 
          {
              $est = "Negado";
          }
          elseif ($solicitud->estados_id  == 3) 
          {
              $est = "Pendiente";
          }
          elseif ($solicitud->estados_id  == 4) 
          {
              $est = "Documentos Faltantes";
          } 
          elseif ($solicitud->estados_id  == 5) 
          {
              $est = "Vendido";
          } 
          elseif ($solicitud->estados_id  == 6) 
          {
              $est = "Desembolsado";
          }           
          if ($solicitud->producto->tipo  == 1) {
                $creditos[] = $tabla = [
                                        
                                        'estado' => $est,
                                        'codigo_asociado' => $solicitud->cod_asociado,
                                        'cedula' => $solicitud->cedula,
                                        'celular' => $solicitud->celular,
                                        'monto' => $solicitud->monto,
                                        'cuotas' => $solicitud->cuotas,
                                        'codigo' => $solicitud->codigo,
                                        'obs' => $solicitud->obs,
										'observacion' => $solicitud->observacion,
                                        'pendiente' => $solicitud->pendiente,
										'aprobado' => $solicitud->aprobado,
										'negado' => $solicitud->negado,
										'desembolsado' => $solicitud->desembolsado,
										'vendido' => $solicitud->vendido,
                                      ];
          }else if($solicitud->producto->tipo  == 2){
                $servicios[] = $tabla = [
                                    'estado' => $est,
                                        'codigo_asociado' => $solicitud->cod_asociado,
                                        'cedula' => $solicitud->cedula,
                                        'celular' => $solicitud->celular,
                                        'monto' => $solicitud->monto,
                                        'cuotas' => $solicitud->cuotas,
                                        'codigo' => $solicitud->codigo,
                                        'obs' => $solicitud->obs,
										'observacion' => $solicitud->observacion,
                                        'pendiente' => $solicitud->pendiente,
										'aprobado' => $solicitud->aprobado,
										'negado' => $solicitud->negado,
										'desembolsado' => $solicitud->desembolsado,
										'vendido' => $solicitud->vendido,
 
                                  ];

          }         

        }
/*
        if (empty($result)) {
            session()->flash('error', 'Resultado vacíos');
            return redirect()->back();
        }
*/ 
        Excel::create(
            'solicitudes',
            function ($excel) use ($creditos, $servicios) {
                $excel->sheet(
                    'Creditos',
                    function ($sheet) use ($creditos) {
                        $sheet->fromArray($creditos);
                    }
                );
                $excel->sheet(
                    'Servicios',
                    function ($sheet) use ($servicios) {
                        $sheet->fromArray($servicios);
                    }
                );
            }
        )->export('xls'); 
    }

    public function excelEstados(Request $request, $id)
    {
        $solicitudes = p_solicitud::where('estados_id',$id)->get();

        foreach ($solicitudes as $solicitud) {

            $result[] = $tabla = [
                                    'Asociado' => $solicitud->user->name, 
                                    'Producto' => $solicitud->producto->name, 
                                    'cod_asociado' => $solicitud->cod_asociado,
                                    'cedula' => $solicitud->cedula,
                                    'celular' => $solicitud->celular,
                                    'monto' => $solicitud->monto,
                                    'cuotas' => $solicitud->cuotas,
                                    'observacion' => $solicitud->observacion
                                ];                               

        }
 
        if (empty($result)) {
            session()->flash('error', 'Resultado vacíos');
            return redirect()->back();
        }
 
        Excel::create(
            'solicitudes',
            function ($excel) use ($result) {
                $excel->sheet(
                    'solicitudes',
                    function ($sheet) use ($result) {
                        $sheet->fromArray($result);
                    }
                );
            }
        )->export('xls'); 
         
    }

    public function excelEstadosOtro(Request $request)
    {
        $solicitudes = p_solicitud::where($request->estado,$request->fecha)->get();
        /*$solicitudes = DB::table('p_solicitud')
            ->select ('*')
            ->where ('opening')
            ->BETWEEN('2018-05-10') AND ('2018-05-14')
            ->get();*/

        foreach ($solicitudes as $solicitud) {
            $result[] = $tabla = [
                                    'Asociado' => $solicitud->user->name, 
                                    'Producto' => $solicitud->producto->name, 
                                    'cod_asociado' => $solicitud->cod_asociado,
                                    'cedula' => $solicitud->cedula,
                                    'celular' => $solicitud->celular,
                                    'monto' => $solicitud->monto,
                                    'cuotas' => $solicitud->cuotas,
                                    'observacion' => $solicitud->observacion
                                ];                               

        }
        
 
        if (empty($result)) {
            session()->flash('error', 'Resultado vacíos');
            return redirect()->back();
        }

        Excel::create(
            'solicitudes',
            function ($excel) use ($result) {
                $excel->sheet(
                    'solicitudes',
                    function ($sheet) use ($result) {
                        $sheet->fromArray($result);
                    }
                );
            }
        )->export('xls'); 
    }


    public function descarga($archivo)
    {
        $public_path = storage_path();
        $url = $public_path.'/app/subidas/productos/'.$archivo;
        return response()->download($url,$archivo);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $row = p_solicitud::find($id);
      return view('adminlte::solicitud_producto.solicitud.comprobante', compact('row'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $row = p_solicitud::find($id);
       return view('adminlte::solicitud_producto.solicitud.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->Validate($request,[           
            'cedula' => 'required|',
            'codigo' => 'required|',
            'monto' => 'required|',
            'cuota' => 'required|',  
            'observaciones' => 'required|',  

        ]);         
        $date = date('Y-m-d', strtotime('20 day'));
        
        $row = p_solicitud::find($id);        
        if ($request->Aprobar) {
            $row->estados_id = 1; 
            $row->aprobado  = Carbon::now();  
            
            $row->close = $date;
        }
        if ($request->Negar) {
             $row->estados_id = 2;
             $row->negado  = Carbon::now();
        }
        $row->monto = $request->monto;
        $row->cuotas = $request->cuota;
        $row->observacion = $request->observaciones;
        $row->save(); 


        $url_datos = "http://190.145.4.62/WebServices/WSEstadoCuenta.asmx/ConsultarDatoBasicosPersona?pEntidad=FONSODI&pIdentificador=".$request->cedula."&pTipo=Identificacion";
        $response_xml_datos = file_get_contents($url_datos);
        $xml_datos = simplexml_load_string($response_xml_datos);
        
        $email = (string)$xml_datos->email; 
        //$email = 'john.moreno@fyclsingenieria.com';


        if ($request->Aprobar) {                               
            Mail::send(new Aprobado($email,$row,$request->codigo));
        }
        if ($request->Negar) {        
             Mail::send(new Negado($email,$row));
        }

        session()->flash('message', 'Guardado correctamente');
        return redirect('solicitudes/solicitados/3');
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function desembolso()
    {
      if (Auth::guard('admin_user')->user()->rol->id == 8) {
         $rows = p_solicitud::where('p_productos_id',Auth::guard('admin_user')->user()->ciudad)->where('estados_id',3)->get(); 
      }else{
         $rows = p_solicitud::where('estados_id',6)->get();         
      }
      
      return view('adminlte::solicitud_producto.solicitud.proveedor.desembolso', ['rows' => $rows ]);
    }

    public function desembolsar($id)
    {
      $row = p_solicitud::find($id);
      return view('adminlte::solicitud_producto.solicitud.proveedor.desembolsar', ['row' => $row ]);
    }

    public function udpateDesembolsar(Request $request, $id)
    {
        $this->Validate($request,[           
            'cedula' => 'required|',
            'codigo' => 'required|',
            'monto' => 'required|', 
            'observaciones' => 'required|',  
        ]);         
        
        $row = p_solicitud::find($id);
        $row->estados_id = 5;
        $row->monto = $request->monto;
        $row->observacion = $request->observaciones;
        $row->vendido  = Carbon::now();
        $row->save(); 

        $url_datos = "http://190.145.4.62/WebServices/WSEstadoCuenta.asmx/ConsultarDatoBasicosPersona?pEntidad=FONSODI&pIdentificador=".$request->cedula."&pTipo=Identificacion";
        $response_xml_datos = file_get_contents($url_datos);
        $xml_datos = simplexml_load_string($response_xml_datos);        
        $email = (string)$xml_datos->email; 
        //$email = 'corpjorge@hotmail.com';
        
        
        $banks = DB::table('p_solicitudes as p')
            ->join('banks as b', 'b.id', '=', 'p.bank_id')
            ->select('b.name as banco', 'p.account as cuenta', 'b.time as tiempo')
            ->where('p.id', '=', $id)
            ->get();
       
        
            if ($row->producto->tipo == 1 ) {
               foreach ($banks as $bank) {
                $mensaje = "Estimado Asociado el desembolso de su solicitud ha sido realizado en el: " . $bank->banco . ", a la cuenta # " . $bank->cuenta . " en un máximo de " . $bank->tiempo . " horas tendrá los recursos transferidos a su cuenta";
                }
            }
            elseif($row->producto->tipo == 2 ) {
                $mensaje = "Estimado Asociado, uno de nuestros coordinadores comerciales se comunicara con usted para indicarle la forma y momento de entrega del producto solicitado, cualquier información adicional por favor comuníquese a los teléfonos 7436880 ext. 5106 y 5110 y 3144704924";
            }
            else{
              $mensaje = 'Estimado Asociado su solicitud de consumo fue aprobada exitosamente';
            }  
        
        

        Mail::send(new Desembolsar($email,$row,$mensaje)); 

        session()->flash('message', 'Guardado correctamente');
        return redirect('solicitudes/desembolso');
         
    }
    
    public function file()
    {
        return view('adminlte::solicitud_producto.solicitud.file');
    }
    
    public function servicio()
    {
        return view('adminlte::solicitud_producto.solicitud.file-servicio');
    }
    
    public function producto()
    {
        return view('adminlte::solicitud_producto.solicitud.file-producto');
    }
    
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeConsumoService(Request $request)
    {
        /* Collect Data  */
        
        $cedula = $request->cedula;
        $email = $request->email;
        $celular = $request->celular;
        $direccion_entrega = $request->direccion_entrega;
        $direccion_facturacion = $request->direccion_facturacion;
        $valor_compra = $request->valor_compra;
        $fecha = $request->fecha;
        
        
        
        
        $userdata = array('email'=>'john.moreno@fyclsingenieria.com','password'  => '111111');
        Auth::attempt($userdata);
        
        $consumo = new Consumo;
        $consumo->cedula = $cedula;
        $consumo->email = $email;
        $consumo->celular = $celular;
        $consumo->direccion_entrega = $direccion_entrega;
        $consumo->direccion_facturacion = $direccion_facturacion;
        $consumo->valor_compra = $valor_compra;
        $consumo->fecha = Carbon::now()->format('Y-m-d');
        $consumo->save();
        
      
        if ($consumo->save()) {
        return response()->json(['success' => 1]);
        }
    
        return response()->json(['success' => -1]);
        
        
    }
    


}
