<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Sistema\Permiso;
use App\Model\Sistema\Area_admin;
use App\AdminUser;

class ConfigPermisosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $permisos  = Permiso::all();
      return view('adminlte::admin.permisos.permisos',[ 'permisos' => $permisos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $area_admins  = Area_admin::all();
      $adminUsers  = AdminUser::all();
      return view('adminlte::admin.permisos.add',[ 'area_admins' => $area_admins, 'adminUsers' => $adminUsers ]);
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
          'usuario' => 'required|',
          'area' => 'required|',
      ]);

      $permisos = new Permiso;
      $permisos->admin_user_id = $request->usuario;
      $permisos->area_admin_id  = $request->area;
      $permisos->save();
      session()->flash('message', 'Guardado correctamente');
      return redirect('admin_config/permisos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $permiso  = Permiso::find($id);
      return view('adminlte::admin.permisos.ver',compact('permiso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $permiso  = Permiso::find($id);
      $area_admins  = Area_admin::all();
      $adminUsers  = AdminUser::all();
      return view('adminlte::admin.permisos.update', compact('permiso'),[ 'area_admins' => $area_admins, 'adminUsers' => $adminUsers ] );
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
          'usuario' => 'required|',
          'area' => 'required|',

      ]);

      $permiso = Permiso::find($id);
      $permiso->admin_user_id = $request->usuario;
      $permiso->area_admin_id  = $request->area;
      $permiso->save();
      session()->flash('message', 'Actualizado correctamente');
      return redirect('admin_config/permisos/ver/'.$id.'/edit');
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
