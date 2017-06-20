@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<section class="content-header">
    <h1>Usuario Editar
    <small>Editar usuario</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</li>
		<li><a href="{{ url('admin_config/user')}}">Configuracion</a></li>
			  <li><a href="{{ url ('admin_config/user')}}">Usuario</a></li>
        <li class="active"><a href="#">Editar</a></li>
    </ol>
</section>
<br>
	<div class="container-fluid spark-screen">
		<div class="row">


			@include('adminlte::admin.user.atras')



		<div class="">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Actualizar Usuario</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ url('admin_config/user/'.$adminUser->id)}}" method="post">
							@if (count($errors) > 0)
			            <div class="alert alert-danger">
			                <strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
			                <ul>
			                    @foreach ($errors->all() as $error)
			                        <li>{{ $error }}</li>
			                    @endforeach
			                </ul>
			            </div>
			        @endif

							@if(session()->has('message'))
						 	 <div class="alert alert-success alert-dismissible">
						 						 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						 						 <h4><i class="icon fa fa-check"></i> Correcto!</h4>
						 						 {{session()->get('message')}}
						 					 </div>
						  @endif

							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							{{method_field('PUT')}}
              <div class="box-body">
								<div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input style="color:#555555"  value="{{$adminUser->name}}" type="text" class="form-control" id="Input1" name="nombre" placeholder="Nombre">
                </div>

								<div class="form-group">
                  <label for="email">Correo</label>
                  <input style="color:#555555"  value="{{$adminUser->email}}" type="text" class="form-control" id="email" name="email" placeholder="correo">
                </div>


								<div class="form-group">
								 <label>Rol</label>
									 <select style="color:#555555" name="rol" class="form-control">
										 	<option value="{{$adminUser->rol->id}}">{{$adminUser->rol->name}}</option>
										 @foreach ($roles as $rol)
								 		 	<option style="color:#555555" value="{{$rol->id}}">{{$rol->name}}</option>
								 		 @endforeach
									 </select>
							 </div>


              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form>
          </div>

		</div>






		</div>
	</div>
@endsection
