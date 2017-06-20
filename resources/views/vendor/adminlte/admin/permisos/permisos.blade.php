@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<section class="content-header">
    <h1>Permisos
    <small>Configuracion de Permisos</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</li>
		<li><a href="{{ url('/admin_config/permisos')}}">Configuracion</a></li>
        <li class="active"><a href="#">Permisos</a></li>
    </ol>
</section>
<br>

	<div class="container-fluid spark-screen">
		<div class="row">

			<div class="row">
				<a href="{{ url('/admin_config/permisos/add') }}" >
					 <div class="col-md-1">
							 <span class="info-box-icon bg-aqua"><i class="fa fa-plus"></i></span>
					 </div>
				</a>
			</div><br>

		@if(session()->has('message'))
		 <div class="alert alert-success alert-dismissible">
							 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							 <h4><i class="icon fa fa-check"></i> Correcto!</h4>
							 {{session()->get('message')}}
						 </div>
		@endif

		<div class="box">
             <div class="box-header">
               <h3 class="box-title">Permisos</h3>
             </div>
             <!-- /.box-header -->
             <div class="box-body">
               <table id="example" class="table table-bordered table-striped">
                 <thead>
                 <tr>
									 <th>#</th>
                   <th>Area</th>
									 <th>Usuario</th>
									 <th>Editar</th>
									 <th>Fecha</th>
                 </tr>
                 </thead>
                 <tbody>
								 @foreach ($permisos as $permiso)
                 <tr>
									 	 <td>{{$permiso->id}}</td>
										 <td><a href="{{url('admin_config/user/ver/'.$permiso->permiso_admin_user->id)}}" >{{$permiso->permiso_admin_user->name}}</a></td>
	                   <td><a href="{{url('admin_config/areas_admin/ver/'.$permiso->permiso_area_admin->id)}}" >{{$permiso->permiso_area_admin->name}}</td>
										 <td><a href="{{url('admin_config/permisos/ver/'.$permiso->id.'/edit')}}" >
											  <i class="fa fa-fw fa-edit"></i>Editar</a>
										 </td>
										 <td>{{$permiso->created_at->diffForHumans()}}</td>
								 </tr>
								 @endforeach

                 </tfoot>
               </table>
             </div>
             <!-- /.box-body -->
           </div>


		</div>
	</div>
@endsection
