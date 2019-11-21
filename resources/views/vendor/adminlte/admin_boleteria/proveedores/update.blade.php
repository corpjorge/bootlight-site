@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<section class="content-header">
    <h1>Proveedores Editar
    <small>Editar Proveedor</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</li>
		<li><a href="{{ url('/admin_boleteria')}}">Boletería</a></li>
			  <li><a href="{{ url ('admin_boleteria/productos')}}">Proveedores</a></li>
        <li class="active"><a href="#">Editar</a></li>
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
    </div><br>


		<div class="">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Actualizar proveedor {{$proveedor->name}}</h3>
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

						  @if(session()->has('error'))
						 	 <div class="alert alert-danger alert-dismissible">
						 						 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						 						 <h4><i class="icon fa fa-check"></i> Error!</h4>
						 						 {{session()->get('error')}}
						 					 </div>
						  @endif



							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							{{method_field('PUT')}}
              <div class="box-body">
              	<div class="form-group">
                  <label for="nit">NIT</label>
                  <input style="color:#555555"  value="{{$proveedor->nit}}" type="text" class="form-control" name="nit" placeholder="Nit" id="nit">
                </div>

                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input style="color:#555555"  value="" type="text" class="form-control" placeholder="Buscar" id="nombre" disabled>
                </div>

								<div class="form-group">
								 <label>
                      <input type="radio" name="estados_id" id="estados_id" value="1" checked=""> Activado
                 </label><br>
								 <label>
                      <input type="radio" name="estados_id" id="estados_id" value="2" > Desactivado
                 </label>

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
