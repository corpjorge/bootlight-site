<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\AdminUser;
use Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $admin  = AdminUser::find(Auth::guard('admin_user')->user()->id);
      return view('adminlte::admin.perfil');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ver($id)
    {
      $admin  = AdminUser::find($id);
      // return view('adminlte::admin.verperfil',compact('admin'));
      // return view('adminlte::admin.perfil',compact('admin'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function help()
    {
      return view('adminlte::admin.help');
    }
}
