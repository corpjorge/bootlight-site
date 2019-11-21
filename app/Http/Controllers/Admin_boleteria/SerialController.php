<?php

namespace App\Http\Controllers\Admin_boleteria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Boleteria\Serial;
use App\Model\Boleteria\Producto;
use App\Model\Boleteria\Proveedor;
use App\Model\Boleteria\Asignacion;

use Validator;
use DB;
use Carbon\Carbon;

class SerialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$seriales  = Serial::all()->where('admin_user_id', '=' ,'');
        $seriales = Serial::where('admin_user_id', '=' ,'')->get();
        //dd($seriales);
        return view('adminlte::admin_boleteria.seriales.seriales',[ 'seriales' => $seriales]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $productos  = Producto::all();

        $this->Validate($request,['cantidad' => 'required|']);

        $cantidad = $request->cantidad;
        $consecutivo = $request->consecutivo;

        if($consecutivo == 1){
            return view('adminlte::admin_boleteria.seriales.add/consecutivo',[ 'cantidad' => $cantidad, 'productos' => $productos]);
        }else{
            return view('adminlte::admin_boleteria.seriales.add/noconsecutivo',[ 'cantidad' => $cantidad, 'productos' => $productos]);
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

        $serial = new Serial;

        $NumeroInicial = $request->NumeroInicial;
        $NumeroFinal   = $request->NumeroFinal;
        $cantidad      = $request->cantidad;
        $LInicial      = $request->LetraInicial;
        $LFinal        = $request->LetraFinal;

        Validator::extend('mayor', function ($attribute, $value, $parameters, $validator) use ($NumeroFinal) {

          if ($value > $NumeroFinal) { return false; }
          else{ return true; }

        });

        Validator::extend('iguales', function ($attribute, $value, $parameters, $validator) use ($NumeroFinal) {

          if ($value == $NumeroFinal) { return false; }
          else{ return true; }

        });

        for ($i = $NumeroInicial; $i <= $NumeroFinal; ++$i) {
              $numero[]=$i;
        }

        if (!isset($numero)) {
          $numero=$cantidad;
        }
        Validator::extend('coincide', function ($attribute, $value, $parameters, $validator) use ($numero) {

           if(count($numero) == $value){ return true; }
           else{ return false; }

        });

        $this->Validate($request,[
            'consecutivo' => 'required|',
            'cantidad' => 'required|numeric|coincide',
            'producto' => 'required|',
            'NumeroInicial' => 'required|numeric|mayor|iguales',
            'NumeroFinal' => 'required|numeric|',
            'precio_compra' => 'required|numeric|',
            'precio_publico' => 'required|numeric|',
            'fecha_caducidad' => 'required|date|',
          ]);


        $fecha_created_at = Carbon::now();

        for ($i = $NumeroInicial; $i <= $NumeroFinal; ++$i) {

              DB::table('seriales')->insert(
                  [
                    'producto_id' => $request->producto,
                    'numero' =>  $request->$serial=($LInicial.$numero[]=$i.$LFinal),
                    'precio_compra' =>  $request->precio_compra,
                    'precio_publico' =>  $request->precio_publico,
                    'precio_venta' =>  "",
                    'fecha_caducidad' =>  $request->fecha_caducidad,
                    'admin_user_id' =>  NULL,
                    'estado_actual_id' =>  3,
                    'created_at' =>  $fecha_created_at,
                  ]
              );

        }

         session()->flash('message', 'Guardado correctamente');
         return redirect('admin_boleteria/seriales');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeNo(Request $request)
    {
      $this->Validate($request,[
          'producto' => 'required|',
          'cantidad' => 'required|numeric|',
          'numero' => 'required|unique:seriales',
          'precio_compra' => 'required|numeric|',
          'precio_publico' => 'required|numeric|',
          'fecha_caducidad' => 'required|date|',
        ]);

        $fecha_created_at = Carbon::now();

        for ($i = 0; $i < $request->cantidad; $i++) {
          DB::table('seriales')->insert([
            [
              'producto_id' => $request->producto,
              'numero' =>  $request->numero[$i],
              'precio_compra' =>  $request->precio_compra,
              'precio_publico' =>  $request->precio_publico,
              'precio_venta' =>  "",
              'estado_actual_id' =>  3,
              'fecha_caducidad' =>  $request->fecha_caducidad,
              'created_at' =>  $fecha_created_at,
            ]
        ]);
      }

      session()->flash('message', 'Guardado correctamente');
      return redirect('admin_boleteria/seriales');


    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Serial  $serial
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $serial  = Serial::find($id);
      $asignaciones = Serial::find($id)->serial_asignacion;
      return view('adminlte::admin_boleteria.seriales.ver', compact('serial'), ['asignaciones' => $asignaciones]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Serial  $serial
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $serial  = Serial::find($id);
      $productos  = Producto::all();
      return view('adminlte::admin_boleteria.seriales.update', compact('serial'), ['productos' => $productos] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Serial  $serial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $serial = Serial::find($id);

        $this->Validate($request,[
            'producto' => 'required|',
            'numero' => 'required|',
            'precio_compra' => 'required|numeric|',
            'precio_publico' => 'required|numeric|',
            'fecha_caducidad' => 'required|date|',
          ]);

        $serial->producto_id = $request->producto;
        $serial->numero = $request->numero;
        $serial->Precio_compra = $request->precio_compra;
        $serial->Precio_publico = $request->precio_publico;
        $serial->fecha_caducidad = $request->fecha_caducidad;
        $serial->save();

        session()->flash('message', 'Actualizado correctamente');
        return redirect('admin_boleteria/seriales/ver/'.$id.'/edit');
    }


}
