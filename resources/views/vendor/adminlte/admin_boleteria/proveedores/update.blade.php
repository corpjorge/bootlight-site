@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">

		<div class="row">
			<a href="{{url('admin_boleteria/proveedores')}}" >
         <div class="col-md-1">
             <span class="info-box-icon bg-yellow"><i class="fa fa-chevron-left"></i></span>
         </div>
			</a>
    </div><br>


		<div class="">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Actualizar proveedor</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ url('admin_boleteria/proveedores/'.$proveedor->id)}}" method="post">
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
								 <label>Tipo Documento</label>
									 <select style="color:#555555" name="linea" class="form-control">
										 	<option style="color:#555555" value="{{$proveedor->proverdor_linea->id}}">{{$proveedor->proverdor_linea->name}}</option>
										 @foreach ($lineas as $linea)
								 		 	<option style="color:#555555" value="{{$linea->id}}">{{$linea->name}}</option>
								 		 @endforeach
									 </select>
							 </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Codigo</label>
                  <input style="color:#555555" type="number" class="form-control" id="exampleInputPassword1" name="codigo" value="{{$proveedor->codigo}}" placeholder="Documento">
                </div>

								<div class="form-group">
                  <label for="exampleInputPassword1">Nombre</label>
                  <input style="color:#555555" type="text" class="form-control" id="exampleInputPassword1" name="nombre" value="{{$proveedor->name}}" placeholder="Nombre">
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
