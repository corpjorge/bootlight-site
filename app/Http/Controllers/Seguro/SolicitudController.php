<?php

namespace App\Http\Controllers\Seguro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Usuario\Users_detalle;

use App\Model\Seguro\Archivo;
use App\Model\Seguro\Seguro;
use App\Model\Seguro\Seguros_producto;
use App\Model\Seguro\Seguros_documento;
use App\Model\Seguro\Seguros_estado;
use App\Model\Sistema\Correo_notication;
use App\Mail\Seguro\Seguro as Correoseguro;


use Illuminate\Support\Facades\Storage;
use File;
use Validator;
use Auth;
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
        $seguro_productos = Seguros_producto::all();
        return view('adminlte::usuario.seguro.solicitud', ['seguro_productos' => $seguro_productos]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function segurosvista()
    {
      $seguros = Seguro::all()->where('user_id', Auth::user()->id);
      $cantarchitotal = Archivo::where('user_id', Auth::user()->id)->count();
      $seguros = Seguro::all()->where('user_id', Auth::user()->id);
      return view('adminlte::usuario.seguro.seguros',compact('cantarchitotal'),[ 'seguros' => $seguros]);

    }

    public function segurosvistaestado($id)
    {
      $segurosarchivos = Seguro::find($id)->seguro_archivos->where('user_id', Auth::user()->id);
      return view('adminlte::usuario.seguro.seguros',compact('cantarchitotal'),[ 'segurosarchivos' => $segurosarchivos,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function info($id)
    {
        $seguro_producto = Seguros_producto::find($id);
        $seg_documentos = Seguros_producto::find($id)->seguro_documento;
        $public_path = storage_path();
        return view('adminlte::usuario.seguro.info', compact('seguro_producto','public_path'),['seg_documentos' => $seg_documentos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function terminos($id)
    {
        $seguro_producto = Seguros_producto::find($id);
        return view('adminlte::usuario.seguro.terminos', compact('seguro_producto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $seguro_producto = Seguros_producto::find($id);

        $seguro = new Seguro;
        $seguro->user_id = Auth::user()->id;
        $seguro->seguros_producto_id = $seguro_producto->id;
        $seguro->estado_id = 4;
        $seguro->observacion_general = 'Por favor ingrese Documentación faltante';
        $seguro->save();
        session()->flash('message', 'Ingrese documentación faltante');
        return redirect('seguros');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Seguro  $seguro
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $seguro  = Seguro::find($id)->where('user_id', Auth::user()->id)->first();
        $segurosarchivos = Archivo::where('seguro_id',$id)->where('user_id', Auth::user()->id)->get();
        $estados = Seguros_estado::where('seguro_id',$id)->get();
        return view('adminlte::usuario.seguro.ver', compact('seguro'),['segurosarchivos' => $segurosarchivos, 'estados' => $estados]);
    }


    public function descarga($id)
    {
      //$segurosarchivos = Seguro::find($id)->seguro_archivos->where('user_id', Auth::user()->id);

      $archivo = Archivo::find($id);
      $public_path = storage_path();

      $url = $public_path.'/app/'.$archivo->ruta;

      $exists = Storage::disk('local')->has($url);

      //verificamos si el archivo existe y lo retornamos
      if ($exists = Storage::disk('local')->has($archivo->ruta))
      {
        return response()->download($url, $archivo->nombre);
      }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Seguro  $seguro
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $segurouser = Seguro::where('id','=', $id)->where('user_id' ,Auth::user()->id)->first();
      $segurosarchivos = Seguro::find($id)->seguro_archivos->where('user_id', Auth::user()->id);
      $seg_documentos = Seguros_producto::find($segurouser->seguros_producto_id)->seguro_documento;
      return view('adminlte::usuario.seguro.documentos', compact('segurouser','segurosarchivos'),['seg_documentos' => $seg_documentos]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seguro  $seguro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $files = $request->file('file');
      $user = Users_detalle::find(Auth::user()->id);
      // $correo = Correo_notication::where('admin_user_id',Auth::user()->id);

      foreach($files as $file){

       $fileNameOrginal=$file->getClientOriginalName();
       $fileName=str_random(40);
       $fileType=$file->guessExtension();
       $fileSize=$file->getClientSize();
       //$fileSize=$file->getClientSize()/1024;
       Storage::disk('local')->put($fileName,  \File::get($file));
       $ubicacion = 'subidas/seguros/'.$user->cedula.'/'.$fileName.'.'.$fileType;
       Storage::move($fileName, $ubicacion);

       $file = new Archivo;
       $file->user_id = Auth::user()->id;
       $file->seguro_id = $id;
       $file->estado_aprobacion_id = 2;
       $file->nombre = $fileNameOrginal;
       $file->ruta = $ubicacion;
       $file->tipo = $fileType;
       $file->tamaño = $fileSize;
       $file->save();

       }

        $seguro = Seguro::where('id','=',$id)->where('user_id' ,Auth::user()->id)->first();
        $seguro->estado_id = 3;
        $seguro->observacion_general = 'Archivos pendientes por validación';
        $seguro->save();

        $correos = Correo_notication::where('dependencia_id',3)->get();

        foreach ($correos as $correo) {
          Mail::to($correo->correo_noti_admin_user->email, $correo->correo_noti_admin_user->name,
                   $seguro->id, $seguro->seguro_usuario->name,
                   $seguro->observacion_general,$seguro->id,
                   $seguro->seguro_producto->name)
           ->send(new Correoseguro($correo, $seguro));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seguro  $seguro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      /*
      $producto = producto::find($id);
      $producto->delete();
      session()->flash('message', 'Borrado correctamente');
      return redirect('admin_boleteria/producto/');
      */

    }


}
