@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<section class="content-header">
    <h1>Permisos añadir
    <small>Configuracion de permisos</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</li>
		<li><a href="{{ url('/admin_config/permisos')}}">Configuracion</a></li>
			  <li><a href="{{ url ('admin_config/permisos')}}">Permisos</a></li>
        <li class="active"><a href="#">Añadir</a></li>
    </ol>
</section>
<br>
	<div class="container-fluid spark-screen">
		<div class="row">

		@include('adminlte::admin.permisos.atras')

		<div class="">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Añadir Permiso</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ url('admin_config/permisos/') }}" method="post">
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
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="box-body">


								<div class="form-group">
								 <label>Usuario</label>
									 <select style="color:#555555" name="usuario" class="form-control">
										 	<option></option>
										 @foreach ($adminUsers as $adminUser)
								 		 	<option style="color:#555555" value="{{$adminUser->id}}">{{$adminUser->name}}</option>
								 		 @endforeach
									 </select>
							 </div>

							 <div class="form-group">
								<label>Area</label>
									<select style="color:#555555" name="area" class="form-control">
										 <option></option>
										@foreach ($area_admins as $area_admin)
										 <option style="color:#555555" value="{{$area_admin->id}}">{{$area_admin->name}}</option>
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
