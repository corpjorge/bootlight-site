@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">

			@include('adminlte::admin_boleteria.seriales.atras')

		<div class="">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Actualizar Producto</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ url('admin_boleteria/seriales/'.$serial->id)}}" method="post">
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
								 <label>Producto</label>
									 <select style="color:#555555" name="producto" class="form-control">
										 	<option value="{{$serial->producto_id}}">{{$serial->serial_producto->nombre}}</option>
										 @foreach ($productos as $producto)
								 		 	<option style="color:#555555" value="{{$producto->id}}">{{$producto->nombre}}</option>
								 		 @endforeach
									 </select>
							 </div>

							 <div class="form-group">
								 <label for="nombre">Serial</label>
								 <input style="color:#555555"  value="{{$serial->numero}}" type="text" class="form-control" id="numero" name="numero" placeholder="Serial">
							 </div>

							 <div class="form-group">
								 <label for="nombre">Precio de compra</label>
								 <input style="color:#555555"  value="{{$serial->precio_compra}}" type="number" class="form-control" id="Precio_compra" name="precio_compra" placeholder="Precio de compra">
							 </div>

							 <div class="form-group">
								 <label for="nombre">Precio al publico</label>
								 <input style="color:#555555"  value="{{$serial->precio_publico}}" type="number" class="form-control" id="Precio_publico" name="precio_publico" placeholder="Precio al publico">
							 </div>

							 <div class="form-group">
								 <label for="nombre">fecha de caducidad</label>
								 <input style="color:#555555"  value="{{$serial->fecha_caducidad}}" type="date" class="form-control" id="fecha_caducidad" name="fecha_caducidad" placeholder="fecha_caducidad">
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
