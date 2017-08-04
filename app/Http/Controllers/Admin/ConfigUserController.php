<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AdminUser;
use App\Model\Sistema\Rol;
use App\Model\Usuario\Ciudad;

class ConfigUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $adminUsers  = AdminUser::all();
      return view('adminlte::admin.user.user',[ 'adminUsers' => $adminUsers]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles  = Rol::all();
        $cuidades  = Ciudad::all();
        return view('adminlte::admin.user.add',[ 'cuidades' => $cuidades, 'roles' => $roles]);
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
            'email' => 'required|unique:admin_users',
            'rol' => 'required|',
            'ciudad' => 'required|',
        ]);

        $adminUser = new AdminUser;
        $adminUser->name = $request->nombre;
        $adminUser->email  = $request->email;
        $adminUser->role_id  = $request->rol;
        $adminUser->password  = '';
        $adminUser->ciudad  = $request->ciudad;
        $adminUser->save();
        session()->flash('message', 'Guardado correctamente');
        return redirect('admin_config/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $adminUser  = AdminUser::find($id);
      return view('adminlte::admin.user.ver',compact('adminUser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $adminUser  = AdminUser::find($id);
      $roles  = Rol::all();
      return view('adminlte::admin.user.update', compact('adminUser'),[ 'roles' => $roles] );
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
          'email' => 'required|',
          'rol' => 'required|',
      ]);

      $adminUser = AdminUser::find($id);
      $adminUser->name = $request->nombre;
      $adminUser->email  = $request->email;
      $adminUser->role_id  = $request->rol;
      $adminUser->save();
      session()->flash('message', 'Actualizado correctamente');
      return redirect('admin_config/user/ver/'.$id.'/edit');

    }

}
