<?php

namespace App\Http\Controllers\Servicio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Servicio\Pqr;
use App\Model\Sistema\Estados_aprobacion;

use Auth;

class PqrsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pqrs = Pqr::all()->where('user_id',Auth::user()->id);
        return view('adminlte::usuario.pqrs.add',[ 'pqrs' => $pqrs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pqrs = Pqr::orderBy('id', 'desc')->get();
        return view('adminlte::admin_pqrs.pqrs',[ 'pqrs' => $pqrs]);
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
            'tipo' => 'required|',
            'descripcion' => 'required|',
            'file' => 'mimes:pdf',
            'terminos' => 'required|',
        ]);

        $file = $request->file('file');
        $nombre = str_random(40);
        if (!empty($file)) {
          $fileType=$file->guessExtension();
          \Storage::disk('local')->put($nombre,  \File::get($file));
           $ubicacion = 'subidas/pqrs/'.$nombre.'.'.$fileType;
          \Storage::move($nombre, $ubicacion);
        }
        else {
          $ubicacion = '';
        }
        $pqr = new Pqr;
        $pqr->user_id = Auth::user()->id;
        $pqr->tipo  = $request->tipo;
        $pqr->descripcion  = $request->descripcion;
        $pqr->archivo  = $ubicacion;
        $pqr->estado_id  = 3;
        $pqr->observacion  = 'Pendiente por revisión';
        $pqr->save();
        session()->flash('message', 'Guardado correctamente');
        return redirect('pqrs');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $pqrs = Pqr::find($id);
      $estados = Estados_aprobacion::all();
      return view('adminlte::admin_pqrs.ver',compact('pqrs'),[ 'estados' => $estados]);
    }

    public function descarga($id)
    {

      $pqrs = Pqr::find($id);

      if ($pqrs->archivo == '') {
        session()->flash('message', 'No se adjuntó ningún archivo');
        return redirect('admin_servicios/pqrs/ver/'.$id);
      }
      else{
        $public_path = storage_path();
        $url = $public_path.'/app/'.$pqrs->archivo;
        $exists = \Storage::disk('local')->has($url);
        //verificamos si el archivo existe y lo retornamos
        if ($exists = \Storage::disk('local')->has($pqrs->archivo))
        {
          return response()->download($url, $pqrs->tipo.'.pdf');
        }

      }



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
          'estado' => 'required|',
          'observacion' => 'required|',
      ]);

      $pqrs = Pqr::find($id);
      $pqrs->estado_id = $request->estado;
      $pqrs->observacion = $request->observacion;
      $pqrs->save();
      session()->flash('message', 'Actualizado correctamente');
      return redirect('admin_servicios/pqrs');
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
