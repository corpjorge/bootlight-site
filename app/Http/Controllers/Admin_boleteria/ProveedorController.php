<?php

namespace App\Http\Controllers\Admin_boleteria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Boleteria\Proveedor;
use App\Model\Boleteria\Linea;

use Validator;
use DB;
use Carbon\Carbon;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores  = Proveedor::where('estados_id',1)->get();
        return view('adminlte::admin_boleteria.proveedores.proveedores',[ 'proveedores' => $proveedores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function actualizar()
    {
      $fecha_created_at = Carbon::now();

      //servicios
      $url_servicios = "http://190.145.4.62/WebServices/WSEstadoCuenta.asmx/PoblarListaDesplegable?pTabla=lineasservicios&pColumnas=cod_linea_servicio,nombre&pCondicion=&pOrden=nombre";
      $response_servicios = file_get_contents($url_servicios);
      $servicios = simplexml_load_string($response_servicios);

      //Líneas administradas por cartera
      $url_cartera = "http://190.145.4.61/WebServicesDemo/WSCredito.asmx/ListaDestinacionCredito?pCod_linea_Credito=8";
      $response_cartera = file_get_contents($url_cartera);
      $cartera_lineas = simplexml_load_string($response_cartera);

      $proveedores  = Proveedor::all();

      foreach ($servicios as $servicio) {
        $proveedores  = Proveedor::where('name',$servicio->descripcion)->first();
        if ($proveedores == null) {

          DB::table('proveedores')->insert(
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
        $proveedores  = Proveedor::where('name',$cartera->descripcion)->first();
        if ($proveedores == null) {
          DB::table('proveedores')->insert(
              [
                'codigo' => $cartera->cod_destino,
                'name' =>  $cartera->descripcion,
                'linea' =>  8,
                'created_at' =>  $fecha_created_at,
              ]
          );
        }
      }

      session()->flash('message', 'Listado actualizado');
      return redirect('admin_boleteria/proveedores/add');

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $proveedores  = Proveedor::all();
      return view('adminlte::admin_boleteria.proveedores.add', ['proveedores' => $proveedores]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function linea(Request $request)
    {
      /*
        $this->Validate($request,[
            'codigo' => 'required|unique:lineas',
        ]);

        $url_lineas ="http://190.145.4.62/WebServices/WSEstadoCuenta.asmx/PoblarListaDesplegable?pTabla=lineascredito&pColumnas=cod_linea_credito,nombre&pCondicion=cod_linea_credito=".$request->codigo."&pOrden=cod_linea_credito";
        $response_lineas = file_get_contents($url_lineas);
        $lineasWS = simplexml_load_string($response_lineas);

        $linea = new Linea;
        $linea->codigo = $lineasWS->ListaDesplegable->idconsecutivo;
        $linea->name  = $lineasWS->ListaDesplegable->descripcion;
        $linea->save();
        session()->flash('message1', 'Guardado correctamente');
        return redirect('admin_boleteria/proveedores/add');
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

      $this->Validate($request,[
          'activar' => 'required',

      ]);

      for ($i=0; $i < count($request->activar); $i++) {
        DB::table('proveedores')
            ->where('id', $request->activar[$i])
            ->update(['estados_id' => 1]);
      }

      session()->flash('message', 'Listado actualizado');
      return redirect('admin_boleteria/proveedores');

        /*
        $this->Validate($request,[
            'codigo' => 'required|unique:proveedores',
            'linea' => 'required|',

        ]);

        $url_proveedor = "http://190.145.4.62/WebServices/WSEstadoCuenta.asmx/PoblarListaDesplegable?pTabla=destinacion&pColumnas=cod_destino,descripcion&pCondicion=cod_destino=".$request->codigo."&pOrden=cod_destino";
        $response_proveedor = file_get_contents($url_proveedor);
        $proveedorWS = simplexml_load_string($response_proveedor);

        $proveedor = new Proveedor;
        $proveedor->linea_id = $request->linea;
        $proveedor->codigo  = $proveedorWS->ListaDesplegable->idconsecutivo;
        $proveedor->name  = $proveedorWS->ListaDesplegable->descripcion;
        $proveedor->save();
        session()->flash('message', 'Guardado correctamente');
        return redirect('admin_boleteria/proveedores');

        */

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $proveedor  = Proveedor::find($id);
      return view('adminlte::admin_boleteria.proveedores.ver', compact('proveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $proveedor  = Proveedor::find($id);
      $lineas  = Linea::all();
      return view('adminlte::admin_boleteria.proveedores.update', compact('proveedor'), ['lineas' => $lineas] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->Validate($request,[
          'estados_id' => 'required|',
        ]);

        $proveedor = Proveedor::find($id);
        $proveedor->estados_id = $request->estados_id;
        $proveedor->save();
        session()->flash('message', 'Actualizado correctamente');
        return redirect('admin_boleteria/proveedores');

        /*

        $this->Validate($request,[
          'codigo' => 'required|',
          'linea' => 'required|',
          'nombre' => 'required|',

        ]);
        $proveedor->linea_id = $request->linea;
        $proveedor->codigo  = $request->codigo;
        $proveedor->name  = $request->nombre;
        $proveedor->save();
        session()->flash('message', 'Actualizado correctamente');
        return redirect('admin_boleteria/proveedores/ver/'.$id.'/edit');


        */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      /*
      $proveedor = Proveedor::find($id);
      $proveedor->delete();
      session()->flash('message', 'Borrado correctamente');
      return redirect('admin_boleteria/proveedores/');
      */

    }

}
