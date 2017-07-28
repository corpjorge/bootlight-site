<?php

namespace App\Http\Controllers\Admin_boleteria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Boleteria\Proveedor;
use App\Model\Boleteria\Linea;
use Validator;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores  = Proveedor::all();
        return view('adminlte::admin_boleteria.proveedores.proveedores',[ 'proveedores' => $proveedores]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $url_lineas = "http://190.145.4.62/WebServices/WSEstadoCuenta.asmx/PoblarListaDesplegable?pTabla=lineascredito&pColumnas=cod_linea_credito,nombre&pCondicion=estado=1&pOrden=cod_linea_credito";
        $response_lineas = file_get_contents($url_lineas);
        $lineasWS = simplexml_load_string($response_lineas);

        $url_proveedor = "http://190.145.4.62/WebServices/WSEstadoCuenta.asmx/PoblarListaDesplegable?pTabla=destinacion&pColumnas=cod_destino,descripcion&pCondicion=&pOrden=cod_destino";
        $response_proveedor = file_get_contents($url_proveedor);
        $proveedorWS = simplexml_load_string($response_proveedor);

        $lineas  = Linea::all();
        return view('adminlte::admin_boleteria.proveedores.add', ['lineas' => $lineas, 'lineasWS' => $lineasWS, 'proveedorWS' => $proveedorWS]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function linea(Request $request)
    {
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
        $proveedor = Proveedor::find($id);

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
