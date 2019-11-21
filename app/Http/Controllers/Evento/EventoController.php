<?php

namespace App\Http\Controllers\Evento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Model\Evento\Evento;
Use App\Model\Evento\Eventos_inscripcion;
Use App\Model\Usuario\Ciudad;
Use App\Model\Sistema\Estado;

use Auth;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data  = Evento::get(['title','start','end','url']);
        return Response()->json($data);
    }
    public function indexcalendario()
    {
        return view('adminlte::usuario.evento.calendario');
    }
    public function indexadmin()
    {
        $eventos  = Evento::all();
        return view('adminlte::admin_evento.evento',[ 'eventos' => $eventos]);
    }
    public function inscrip()
    {
      $eventos  = Evento::all()->where('estado_id', 1);
      return view('adminlte::usuario.evento.evento',[ 'eventos' => $eventos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $ciudades  = Ciudad::all();
      $estados  = Estado::all();
      return view('adminlte::admin_evento.add',[ 'ciudades' => $ciudades, 'estados' => $estados ]);
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
          'nombre' => 'required|',
          'fecha_inicio' => 'required|date',
          'fecha_final' => 'required|date',
          'descripcion' => 'required|',
          'condiciones' => 'required|',
          'file' => 'required|image|mimes:jpeg,jpg',
          'ciudad' => 'required|',
          'estado' => 'required|',
      ]);

      $file = $request->file('file');
      $nombre = str_random(40);
      $fileType=$file->guessExtension();
      \Storage::disk('local')->put($nombre,  \File::get($file));
       $ubicacion = 'public/eventos/'.$nombre.'.'.$fileType;
      \Storage::move($nombre, $ubicacion);


      $evento = new Evento;
      $evento->title = $request->nombre;
      $evento->start  = $request->fecha_inicio;
      $evento->end  = $request->fecha_final;
      $evento->condiciones  = $request->condiciones;
      $evento->descripcion  = $request->descripcion;
      $evento->img  = $ubicacion;
      $evento->url  = '/inscripcion';
      $evento->ciudad_id  = $request->ciudad;
      $evento->estado_id  = $request->estado;
      $evento->save();
      session()->flash('message', 'Guardado correctamente');
      return redirect('admin_evento');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $evento = Evento::find($id);
      return view('adminlte::usuario.evento.info', compact('evento'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function inscripcion($id)
    {
        if($evento = Evento::where('id','=',$id)->where('estado_id','!=',1)->first()){
          //session()->flash('messageerror', 'Evento no existe');
          return redirect('inscripcion');
        }else{
             if($evento = Eventos_inscripcion::where('user_id','=',Auth::user()->id )->where('evento_id','=',$id)->first()){
               session()->flash('messageerror', 'Usted ya está inscrito a este evento');
               return redirect('inscripcion');
             }else{
                $evento = new Eventos_inscripcion;
                $evento->user_id = Auth::user()->id;
                $evento->evento_id  = $id;
                $evento->save();
                session()->flash('message', 'Ha sido escrito al evento ');
                return redirect('inscripcion');
              }
         }


    }

    public function estado($id)
    {
        $evento  = Evento::find($id);
        if($evento->estado_id == 1){
           $evento->estado_id  = 2;
           $evento->save();
        }else {
          $evento->estado_id  = 1;
          $evento->save();
        }
        session()->flash('message', 'Guardado correctamente');
        return redirect('admin_evento');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $evento  = Evento::find($id);
      $ciudades  = Ciudad::all();
      $estados  = Estado::all();
      return view('adminlte::admin_evento.update',[ 'ciudades' => $ciudades, 'estados' => $estados, 'evento' => $evento ]);

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
            'nombre' => 'required|',
            'fecha_inicio' => 'required|date',
            'fecha_final' => 'required|date',
            'descripcion' => 'required|',
            'condiciones' => 'required|',
            'file' => 'required|image|mimes:jpeg,jpg',
            'ciudad' => 'required|',
            'estado' => 'required|',
        ]);

        $file = $request->file('file');
        $nombre = str_random(40);
        $fileType=$file->guessExtension();
        \Storage::disk('local')->put($nombre,  \File::get($file));
         $ubicacion = 'public/eventos/'.$nombre.'.'.$fileType;
        \Storage::move($nombre, $ubicacion);


        $evento  = Evento::find($id);
        $evento->title = $request->nombre;
        $evento->start  = $request->fecha_inicio;
        $evento->end  = $request->fecha_final;
        $evento->condiciones  = $request->condiciones;
        $evento->descripcion  = $request->descripcion;
        $evento->img  = $ubicacion;
        $evento->ciudad_id  = $request->ciudad;
        $evento->estado_id  = $request->estado;
        $evento->save();
        session()->flash('message', 'Guardado correctamente');
        return redirect('admin_evento');
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
