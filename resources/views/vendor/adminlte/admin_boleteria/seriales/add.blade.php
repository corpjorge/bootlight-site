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
              <h3 class="box-title">Añadir Seriales</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ url('admin_boleteria/seriales/add') }}" method="post">
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
                  <label for="nombre">Nombre</label>
                  <input style="color:#555555" type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del Producto">
                </div>

								<div class="form-group">
								 <label>Proveedor</label>
									 <select style="color:#555555" name="proveedor" class="form-control">
										 	<option></option>
										 @foreach ($proveedores as $proveedor)
								 		 	<option style="color:#555555" value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
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
