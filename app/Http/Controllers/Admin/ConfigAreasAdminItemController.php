<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Sistema\Area_item_admin;
use App\Model\Sistema\Area_admin;

class ConfigAreasAdminItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $area_item_admins  = Area_item_admin::all();
      return view('adminlte::admin.areas_admin_item.areas', [ 'area_item_admins' => $area_item_admins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $area_admins  = Area_admin::all();
      return view('adminlte::admin.areas_admin_item.add', [ 'area_admins' => $area_admins]);
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
          'area' => 'required|',
          'name' => 'required|',
          'descripcion' => 'required|',
      ]);

      $area_item_admin = new Area_item_admin;
      $area_item_admin->area_admin_id = $request->area;
      $area_item_admin->name = $request->name;
      $area_item_admin->descripcion = $request->descripcion;
      $area_item_admin->save();
      session()->flash('message', 'Guardado correctamente');
      return redirect('admin_config/areas_admin_items');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $area_admins = Area_admin::all();
      $area_item_admins = Area_item_admin::find($id);
      return view('adminlte::admin.areas_admin_item.update', compact('area_item_admins'), [ 'area_admins' => $area_admins]);
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
        //
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
