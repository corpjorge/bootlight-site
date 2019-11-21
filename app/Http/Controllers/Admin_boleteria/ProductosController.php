<?php

namespace App\Http\Controllers\Admin_boleteria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Boleteria\Producto;
use App\Model\Boleteria\Proveedor;

use Validator;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos  = Producto::all();
        return view('adminlte::admin_boleteria.productos.productos',[ 'productos' => $productos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedores  = Proveedor::where('estados_id',1)->get();
        return view('adminlte::admin_boleteria.productos.add',[ 'proveedores' => $proveedores]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $producto = new Producto;

        $this->Validate($request,[
            'nombre' => 'required|',
            'proveedor' => 'required|',

        ]);
        $producto->nombre = $request->nombre;
        $producto->proveedor_id  = $request->proveedor;
        $producto->save();
        session()->flash('message', 'Guardado correctamente');
        return redirect('admin_boleteria/productos');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $producto  = Producto::find($id);
      return view('adminlte::admin_boleteria.productos.ver', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $producto  = Producto::find($id);
      $proveedores  = Proveedor::all();
      return view('adminlte::admin_boleteria.productos.update', compact('producto'), ['proveedores' => $proveedores] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);

        $this->Validate($request,[
          'nombre' => 'required|',
          'proveedor' => 'required|',

        ]);
        $producto->nombre = $request->nombre;
        $producto->proveedor_id  = $request->proveedor;
        $producto->save();
        session()->flash('message', 'Actualizado correctamente');
        return redirect('admin_boleteria/productos/ver/'.$id.'/edit');
    }


}
