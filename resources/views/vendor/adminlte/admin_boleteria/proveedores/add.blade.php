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

		<div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Añadir Línea</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ url('admin_boleteria/proveedores/add/linea') }}" method="post">


							@if(session()->has('message1'))
							 <div class="alert alert-success alert-dismissible">
												 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
												 <h4><i class="icon fa fa-check"></i> Correcto!</h4>
												 {{session()->get('message1')}}
											 </div>
							@endif
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="box-body">

								<div class="form-group">
								 <label>Codigo de Línea</label>
									 <select style="color:#555555" name="codigo" class="form-control">
										 	<option></option>
										 @foreach ($lineasWS as $lineasW)
								 		 	<option style="color:#555555" value="{{$lineasW->idconsecutivo}}">{{$lineasW->idconsecutivo}} - {{$lineasW->descripcion}}</option>
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



		<div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Añadir Codigo Proveedor</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ url('admin_boleteria/proveedores/add') }}" method="post">

							<input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="box-body">
								<div class="form-group">
								 <label>Línea</label>
									 <select style="color:#555555" name="linea" class="form-control">
										 	<option></option>
										 @foreach ($lineas as $linea)
								 		 	<option style="color:#555555" value="{{$linea->id}}">{{$linea->name}}</option>
								 		 @endforeach
									 </select>
							 </div>
							 <div class="form-group">
								<label>Codigo Proveedor</label>
									<select style="color:#555555" name="codigo" class="form-control">
										 <option></option>
										@foreach ($proveedorWS as $proveedorW)
										 <option style="color:#555555" value="{{$proveedorW->idconsecutivo}}">{{$proveedorW->idconsecutivo}} - {{$proveedorW->descripcion}}</option>
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
