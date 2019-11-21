@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">

		<div class="row">
			<a href="{{ url ('admin_servicios/pqrs')}}" >
         <div class="col-md-1">
             <span class="info-box-icon bg-yellow"><i class="fa fa-chevron-left"></i></span>
         </div>
			</a>
    </div><br>

		<div class="col-md-6">
				 <!-- Widget: user widget style 1 -->
				 <div class="box box-widget widget-user-2">
					 <!-- Add the bg color to the header using any of the bg-* classes -->
					 <div class="widget-user-header bg-green">
						 <div class="widget-user-image">
							 @if($pqrs->pqrs_usuario->avatar == '')
							 <img class="img-circle" src="{{ asset('/img/avatar5.png') }}" alt="User Avatar">
							 @else
							 <img class="img-circle" src="{{$pqrs->pqrs_usuario->avatar}}" alt="User Avatar">
							 @endif
						 </div>
						 <!-- /.widget-user-image -->
						 <h3 class="widget-user-username">{{$pqrs->tipo}}</h3>
						 <h5 class="widget-user-desc">{{$pqrs->pqrs_usuario->name}}</h5>
							 <h5 class="widget-user-desc">{{$pqrs->pqrs_usuario->email}}</h5>
					 </div>
					 <div class="box-footer no-padding">
						 <ul class="nav nav-stacked">
							 <li><a>Descripción: {{$pqrs->descripcion}}</a></li>

							 <li><a>Archivo:  </a>
							 <a href="{{url('admin_servicios/pqrs/descarga/'.$pqrs->id)}}" ><i class="fa fa-download" aria-hidden="true"> Archivo</i></a><br>
							 @if(session()->has('message'))
							<div class="alert alert-danger alert-dismissible">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
												{{session()->get('message')}}
											</div>
						 @endif
							 </li>
						 </ul>
					 </div>
				 </div>
				 <!-- /.widget-user -->
			 </div>

<div class="col-md-6">

			 <div class="">
			 			<!-- general form elements -->
			 			<div class="box box-primary">
			 				<div class="box-header with-border">
			 					<h3 class="box-title">Actualizar Estado</h3>
			 				</div>
			 				<!-- /.box-header -->
			 				<!-- form start -->
			 				<form role="form" action="{{ url('admin_servicios/pqrs/'.$pqrs->id)}}" method="post">
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
			 					{{method_field('PUT')}}
			 					<div class="box-body">

			 					 <div class="form-group">
			 						<label>Estado</label>
			 							<select style="color:#555555" name="estado" class="form-control">
			 								 <option style="color:#555555" value="{{$pqrs->pqrs_estado->id}}">{{$pqrs->pqrs_estado->tipo}}</option>
			 								 @foreach($estados as $estado)
			 								 <option style="color:#555555" value="{{$estado->id}}">{{$estado->tipo}}</option>
			 								 @endforeach
			 							</select>
			 					</div>

			 					<div class="form-group">
			 						<label for="exampleInputEmail1">Observación</label>
			 						<input style="color: black;" type="text" class="form-control" id="observacion" name="observacion"  placeholder="Comentario">
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
	</div>
@endsection
