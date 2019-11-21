@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<section class="content-header">
    <h1>Proveedores ingreso
    <small>Ingreso de proveedores</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</li>
		<li><a href="{{ url('/admin_boleteria')}}">Boletería</a></li>
				<li class="active"><a href="{{ url ('admin_boleteria/proveedores')}}">Proveedores</a></li>
        <li class="active"><a href="#">Ingreso</a></li>
    </ol>
</section>
<br>
	<div class="container-fluid spark-screen">
		<div class="row">

		<div class="row">
			<a href="{{url('admin_boleteria/proveedores')}}" >
         <div class="col-md-1">
             <span class="info-box-icon bg-yellow"><i class="fa fa-chevron-left"></i></span>
         </div>
			</a>
			<a href="{{url('admin_boleteria/proveedores/actualizar')}}" >
         <div class="col-md-1">
             <span class="info-box-icon bg-green"><i class="fa fa-refresh"></i></span>Actualizar lista
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


		<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Líneas o proveedores</h3>
            </div>
						@if (count($errors) > 0)
						<div class="alert alert-danger">
								<strong>Error!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
								<ul>
										@foreach ($errors->all() as $error)
												<li>{{ $error }}</li>
										@endforeach
								</ul>
						</div>
						@endif
            <!-- /.box-header -->
            <!-- form start -->
						{!! Form::open(['url' => 'admin_boleteria/proveedores/add']) !!}
            <div class="form-horizontal">
              <div class="box-body">
									@foreach ($proveedores as $proveedor)
		                  <div class="col-md-3">
												<label>
		 										 <input type="checkbox" name="activar[]" value="{{$proveedor->id}}"
												 <?php
													 if ($proveedor->estados_id == 1) {
													 	echo "checked disabled";
													 }
												  ?>> {{$proveedor->name}}
												</label>
		                  </div>
									@endforeach
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">Guardar</button>
              </div>
              <!-- /.box-footer -->
            </div>
						{!! Form::close() !!}
					</div>








		</div>
	</div>
@endsection
