<?php

namespace App\Http\Controllers\Servicio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Servicio\Clasificado;
use App\Model\Sistema\Estados_aprobacion;

use Auth;
use File;

class ClasificadoController extends Controller
{

    public function index()
    {
          $clasificados = Clasificado::all()->where('estado_id',1);
          return view('adminlte::usuario.clasificado.ver',[ 'clasificados' => $clasificados] );
    }

    public function indexadmin()
    {
          $clasificados = Clasificado::orderBy('id', 'desc')->get();
          return view('adminlte::admin_clasificado.clasificados',[ 'clasificados' => $clasificados] );
    }

    public function create()
    {
        $clasificados = Clasificado::all()->where('user_id',Auth::user()->id);
        return view('adminlte::usuario.clasificado.add',[ 'clasificados' => $clasificados]);
    }

    public function store(Request $request)
    {

        $this->Validate($request,[
            'titulo' => 'required|',
            'descripcion' => 'required|',
            'contacto' => 'required|',
            'file' => 'required|image|mimes:jpeg',
            'terminos' => 'required|',
        ]);

        $file = $request->file('file');
        $nombre = str_random(40);
        $fileType=$file->guessExtension();
        \Storage::disk('local')->put($nombre,  \File::get($file));
         $ubicacion = 'public/clasificados/'.$nombre.'.'.$fileType;
        \Storage::move($nombre, $ubicacion);


        $clasificado = new Clasificado;
        $clasificado->user_id = Auth::user()->id;
        $clasificado->titulo  = $request->titulo;
        $clasificado->descripcion  = $request->descripcion;
        $clasificado->contacto  = $request->contacto;
        $clasificado->imagen  = $ubicacion;
        $clasificado->estado_id  = 3;
        $clasificado->observacion  = 'Pendiente por revisión';
        $clasificado->save();
        session()->flash('message', 'Guardado correctamente');
        return redirect('clasificados/add');

    }

    public function show($id)
    {
        $clasificado = Clasificado::find($id);
        return view('adminlte::admin_clasificado.ver',compact('clasificado'));
    }

    public function edit($id)
    {
        $clasificado = Clasificado::find($id);
        $estados = Estados_aprobacion::all();
        return view('adminlte::admin_clasificado.update',compact('clasificado'), [ 'estados' => $estados]);
    }

    public function update(Request $request, $id)
    {

        $this->Validate($request,[
            'estado' => 'required|',
            'titulo' => 'required|',
            'contacto' => 'required|',
            'descripcion' => 'required|',
            'titulo' => 'required|',
            'observacion' => 'required|',
        ]);

        $clasificado = Clasificado::find($id);
        $clasificado->titulo = $request->titulo;
        $clasificado->descripcion = $request->descripcion;
        $clasificado->contacto = $request->contacto;
        $clasificado->estado_id = $request->estado;
        $clasificado->observacion = $request->observacion;
        $clasificado->save();
        session()->flash('message', 'Actualizado correctamente');
        return redirect('admin_servicios/clasificados');
    }


}
