@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<section class="content-header">
    <h1>Áreas administrador añadir
    <small>añadir Areas de administrador</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</li>
		<li><a href="{{ url('/admin_config/areas_admin')}}">Configuracion</a></li>
				<li><a href="{{ url('/admin_config/areas_admin')}}">Areas de administrador</a></li>
        <li class="active"><a href="#">Añadir</a></li>
    </ol>
</section>
<br>
	<div class="container-fluid spark-screen">
		<div class="row">

		@include('adminlte::admin.areas_admin.atras')

		<div class="">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Añadir Area Administrador</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ url('admin_config/areas_admin/add') }}" method="post">
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
									<label for="name">Nombre</label>
									<input style="color:#555555" type="text" class="form-control" id="name" name="name" placeholder="Nombre">
								</div>

								<div class="form-group">
                  <label for="descripcion">Descripcion</label>
                  <input style="color:#555555" type="text" class="form-control" id="descripcion" name="descripcion" placeholder="descripcion">
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
