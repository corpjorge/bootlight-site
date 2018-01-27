<?php

namespace App\Http\Controllers\SolicitudProducto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Usuario\Users_detalle;
use App\Model\solicitudProducto\p_producto;
use App\Model\solicitudProducto\p_solicitud;
use App\Mail\SolicitudProducto\Solicitud;
use App\Mail\SolicitudProducto\Negado;
use App\Mail\SolicitudProducto\Aprobado;

use Maatwebsite\Excel\Facades\Excel;
use App\User;
use auth;
use Mail;

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
          $rows = p_producto::where('estados_id',1)->get();
          return view('adminlte::solicitud_producto.solicitud.create', compact('usuario'),[ 'rows' => $rows]);
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
        ]);



        $file = $request->file('file');
        $nombre = str_random(40);
        $fileType=$file->guessExtension();        
        \Storage::disk('local')->put($nombre,  \File::get($file));
         $ubicacion = 'subidas/productos/'.$nombre.'.'.$fileType;
        \Storage::move($nombre, $ubicacion);
 
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
        $dato->observacion  = 'Pendiente por revisión';
        $dato->save();

        $url_datos = "http://190.145.4.62/WebServices/WSEstadoCuenta.asmx/ConsultarDatoBasicosPersona?pEntidad=FONSODI&pIdentificador=".$request->cedula."&pTipo=Identificacion";
        $response_xml_datos = file_get_contents($url_datos);
        $xml_datos = simplexml_load_string($response_xml_datos);
        $email = 'john.moreno@fyclsingenieria.com';
        Mail::send(new Solicitud($email,$dato));

         
        session()->flash('message', 'Guardado correctamente');
        return redirect('solicitud/productos'); 
    }

    public function solicitudes()
    {
        $pendientes = p_solicitud::where('estados_id',3)->count();
        $aprobado = p_solicitud::where('estados_id',1)->count();
        $negados = p_solicitud::where('estados_id',2)->count();
        $desembolsados = p_solicitud::where('estados_id',6)->count();
        $vendidos = p_solicitud::where('estados_id',5)->count();
        return view('adminlte::solicitud_producto.solicitud.solicitudes', compact('pendientes','aprobado','negados','desembolsados','vendidos')); 
         
    }

    public function solicitudesShow($id)
    { 
      if ($id == 6) {
       $rows = p_solicitud::where('estados_id',$id)->orderBy('id', 'desc')->get();
       return view('adminlte::solicitud_producto.solicitud.desembolsados', [ 'rows' => $rows]);                 
      }
      else{
        $rows = p_solicitud::where('estados_id',$id)->orderBy('id', 'desc')->paginate(30);
        return view('adminlte::solicitud_producto.solicitud.show', [ 'rows' => $rows]);
      } 
    }

    public function codigo(Request $request, $id)
    {       
      $row = p_solicitud::find($id);     
      if ($row->codigo == $request->codigo) {
        $row->estados_id = 6;
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

      for ($i=0; $i < count($request->solicitud); $i++) {     
        $solicitudes = p_solicitud::find($request->solicitud[$i]);
        $solicitudes->estados_id = 5;
        $solicitudes->save(); 
      }
      session()->flash('message', 'Guardado correctamente');
      return redirect('solicitudes/solicitados/6');
       
    }


    public function excel()
    {
        $solicitudes = p_solicitud::where('estados_id',6)->get();

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
        //
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
        
        $row = p_solicitud::find($id);        
        if ($request->Aprobar) {
            $row->estados_id = 1;   
        }
        if ($request->Negar) {
             $row->estados_id = 2;
        }
        $row->monto = $request->monto;
        $row->cuotas = $request->cuota;
        $row->observacion = $request->observaciones;
        $row->save(); 


        $url_datos = "http://190.145.4.62/WebServices/WSEstadoCuenta.asmx/ConsultarDatoBasicosPersona?pEntidad=FONSODI&pIdentificador=".$request->cedula."&pTipo=Identificacion";
        $response_xml_datos = file_get_contents($url_datos);
        $xml_datos = simplexml_load_string($response_xml_datos);
        $email = 'john.moreno@fyclsingenieria.com';

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
}
