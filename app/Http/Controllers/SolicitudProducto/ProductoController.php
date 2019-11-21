<?php

namespace App\Http\Controllers\SolicitudProducto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Usuario\Users_detalle;
use App\Model\solicitudProducto\p_producto;
use App\Model\solicitudProducto\p_solicitud;

use App\User;
use App\AdminUser;
use auth;
use Validator;
use DB;
use Carbon\Carbon;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$productos = p_producto::where('estados_id',1)->get();
        $productos = DB::table('p_productos as p')
                ->join('estados as e', 'e.id', '=', 'p.estados_id')
                ->select('p.estados_id as estado', 'e.estilo as estilo', 'p.codigo as codigo', 'p.name as name','p.created_at' , 'p.id', 'p.tipo as linea')
                ->get();
               
        
        return view('adminlte::solicitud_producto.producto.index', ['productos' => $productos] ); 
         
    }

    public function actualizar()
    {
      $fecha_created_at = Carbon::now();

      //servicios url
      $url_servicios = "http://190.145.4.62/WebServices/WSEstadoCuenta.asmx/PoblarListaDesplegable?pTabla=lineasservicios&pColumnas=cod_linea_servicio,nombre&pCondicion=&pOrden=nombre";
      $response_servicios = file_get_contents($url_servicios);
      $servicios = simplexml_load_string($response_servicios);

      //Líneas administradas por cartera
      $url_cartera = "http://190.145.4.62/WebServices/WSEstadoCuenta.asmx/PoblarListaDesplegable?pTabla=LINEASCREDITO&pColumnas=COD_LINEA_CREDITO,NOMBRE&pCondicion=ESTADO=1&pOrden=NOMBRE";
      $response_cartera = file_get_contents($url_cartera);
      $cartera_lineas = simplexml_load_string($response_cartera);

      $p_productos  = p_producto::all();

      foreach ($servicios as $servicio) {
        $p_productos  = p_producto::where('name',$servicio->descripcion)->first();
        if ($p_productos == null) {

          DB::table('p_productos')->insert(
              [
                'codigo' =>$servicio->idconsecutivo,
                'name' =>  $servicio->descripcion,
                'linea' => 1,
                'created_at' =>  $fecha_created_at,
              ]
          );
        }
      }

      foreach ($cartera_lineas as $cartera) {
        $p_productos  = p_producto::where('name',$cartera->descripcion)->first();
        if ($p_productos == null) {
          DB::table('p_productos')->insert(
              [
                'codigo' => $cartera->idconsecutivo,
                'name' =>  $cartera->descripcion,
                'linea' =>  0,
                'created_at' =>  $fecha_created_at,
              ]
          );
        }
      }

      session()->flash('message', 'Listado actualizado');
      return redirect('solicitudes/productos/add');

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos  = p_producto::all();      
        return view('adminlte::solicitud_producto.producto.add', ['productos' => $productos]); 
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
            'nit' => 'required|',
            'name' => 'required|',
            'cuota_min' => 'required|',
            'cuota_max' => 'required|',
            'monto_min' => 'required|',
            'monto_max' => 'required|',            
            //'correo' => 'required|', 
            'tipo' => 'required|',            
        ]);

        $dato = new p_producto;   
        $dato->nit  = $request->nit; 
        $dato->name = $request->name;
        $dato->linea = $request->linea;
        $dato->codigo = $request->codigo;
        $dato->cuota_min  = $request->cuota_min;    
        $dato->cuota_max  = $request->cuota_max;    
        $dato->monto_min  = $request->monto_min;    
        $dato->monto_max  = $request->monto_max;    
        $dato->tipo  = $request->tipo;    
        $dato->url  = $request->url; 
        $dato->estados_id = 1;
        $dato->save();

      session()->flash('message', 'Producto registrado correctamente');
      return redirect('solicitudes/productos');
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
        $producto  = p_producto::find($id);
        $user = AdminUser::where('ciudad',$producto->id)->first();   
        return view('adminlte::solicitud_producto.producto.edit', compact('producto', 'user')); 
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
            'nit' => 'required|',
            'cuota_min' => 'required|',
            'cuota_max' => 'required|',
            'monto_min' => 'required|',
            'monto_max' => 'required|',            
            //'correo' => 'required|', 
            'tipo' => 'required|',            
        ]);

        $dato = p_producto::find($id);   
        $dato->nit  = $request->nit;    
        $dato->cuota_min  = $request->cuota_min;    
        $dato->cuota_max  = $request->cuota_max;    
        $dato->monto_min  = $request->monto_min;    
        $dato->monto_max  = $request->monto_max;    
        $dato->tipo  = $request->tipo;    
        $dato->url  = $request->url;
        $dato->estados_id = 1;
        $dato->save();

        if ($request->correo) {
        
          $user = AdminUser::where('ciudad',$id)->first(); 

          if ($user) {  
           $user->email = $request->correo;
           $user->save();
          }
          else{     
            $nuevoUser = new AdminUser();
            $nuevoUser->name = $request->nombre;
            $nuevoUser->email = $request->correo;
            $nuevoUser->password = '-';
            $nuevoUser->ciudad = $id;
            $nuevoUser->role_id = 8;
            $nuevoUser->save();
          }
        }
  
        session()->flash('message', 'Producto actualizado correctamente');
        return redirect('solicitudes/productos');
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
    
    public function activar ($id)
    {
        $dato = p_producto::find($id);   
           if($dato->estados_id == 1){
               $dato->estados_id = 2;
               $dato->save();
            }else {
              $dato->estados_id  = 1;
              $dato->save();
            }
        $dato->save();
        
        session()->flash('message', 'Guardado correctamente');
        return redirect('solicitudes/productos');
    }
}
