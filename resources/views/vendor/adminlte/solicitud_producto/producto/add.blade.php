@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<section class="content-header">
    <h1>Productos ingreso
    <small>Ingreso de producto</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</li>
		<li><a href="{{ url('/solicitudes/productos')}}">producto</a></li>
				<li class="active"><a href="{{ url ('solicitudes/productos')}}">Productos</a></li>
        <li class="active"><a href="#">Ingreso</a></li>
    </ol>
</section>
<br>
	<div class="container-fluid spark-screen">
		<div class="row">

		<div class="row">
			<a href="{{url('solicitudes/productos')}}" >
         <div class="col-md-1">
             <span class="info-box-icon bg-yellow"><i class="fa fa-chevron-left"></i></span>
         </div>
			</a>
			<a href="{{url('solicitudes/productos/actualizar')}}" >
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
              <h3 class="box-title">Productos</h3>
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
						{!! Form::open(['url' => 'solicitudes/productos/add']) !!}
            <div class="form-horizontal">
              <div class="box-body">
									@foreach ($productos as $producto)
		                  <div class="col-md-3">
												<label>
		 										 <input type="checkbox" name="activar[]" value="{{$producto->id}}"
												 <?php
													 if ($producto->estados_id == 1) {
													 	echo "checked disabled";
													 }
												  ?>> {{$producto->name}}
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
