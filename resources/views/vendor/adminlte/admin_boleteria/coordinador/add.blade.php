@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">

		@include('adminlte::admin_boleteria.asignacion.atras')


            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ url('admin_boleteria/asignacion/add') }}" method="post">
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




			<div class="box box-primary">
					 <!-- /.box-header -->
					 <div class="box-header with-border">
						 <h3 class="box-title">Asignar seriales</h3>
					 </div>
					 <div class="box-body">
						 <div class="form-group">
								 <label>Usuario</label>
								 <select style="color: black"class="form-control" name="usuario">
									 <option value="">Seleccionar</option>
									 @foreach ($admin_usuarios as $admin_usuario)
										 <option value="{{$admin_usuario->id}}">{{$admin_usuario->name}}</option>
									 @endforeach
								 </select>
							 </div>
						@foreach ($productos as $producto)
							<div class="panel panel-default">
							  <div class="panel-heading">
							    <h3 class="panel-title">{{$producto->nombre}}</h3>
							  </div>
								@foreach ($seriales as $serial)
									@if($serial->serial_producto->nombre == $producto->nombre )
									 <label style="padding: 3px;" for="{{$serial->numero}}">
											 <ul class="todo-list">
												 <li>
													 <input  name="serial[]" id="{{$serial->numero}}" type="checkbox" value="{{$serial->id}}">
													 <span class="text">{{$serial->numero}}</span>
												 </li>
											 </ul>
									   </label>
								  @endif
								 @endforeach
							</div>
						 @endforeach

					 <div class="box-footer">
						 <button type="submit" class="btn btn-primary">Guardar</button>
					 </div>
				 </form>
			 </div>
			 </div>


		</div>
	</div>
@endsection
