@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">

			<div class="row">
				<a href="javascript:history.back()" >
					 <div class="col-md-1">
							 <span class="info-box-icon bg-yellow"><i class="fa fa-chevron-left"></i></span>
					 </div>
				</a>
			</div><br>


<section class="content">

	<div class="box box-widget widget-user">
		<!-- Add the bg color to the header using any of the bg-* classes -->
		<div class="widget-user-header bg-aqua-active">
			<h3 class="widget-user-username">
				{{$users_detalles->usuario->name}}
			</h3>
			<h5 class="widget-user-desc" style="text-transform: capitalize;">{{$users_detalles->usuario->usuario_rol->name}}</h5>
		</div>
		<div class="widget-user-image">
			{{-- @if($users_detalles->usuario->avatar == '')
			<img class="img-circle" src="{{ asset('/img/avatar5.png') }}" alt="User Avatar">
			@else
			<img class="img-circle" src="{{ $users_detalles->usuario->avatar }}" alt="User Avatar">
			@endif --}}
		</div>
		<div class="box-footer">
			<div class="row">
			</div>
			<!-- /.row -->
		</div>
	</div>
      <div class="row">
        <div class="col-md-12">
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Datos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
							<div class="col-md-4">
							  <strong><i class="fa fa-user margin-r-5"></i> Personales </strong>
								<p class="text-muted"><b>Cedula: {{$users_detalles->cedula}}</b>  </p>
								<p class="text-muted"><b>Fecha de vinculación: {{$users_detalles->fecha_vinculacion}} </b></p>
								<p class="text-muted"><b>Fecha de nacimiento: {{$users_detalles->fecha_nacimiento}}</b></p>
								<p class="text-muted"><b>Genero: {{$users_detalles->genero}} </b></p>
								<p class="text-muted"><b>Estado civil: {{$users_detalles->usuario_estado_civil->tipo}} </b></p>
	              <hr>
						  </div>
              <strong><i class="fa fa-map-marker margin-r-5"></i> Ubicación</strong>

              <p class="text-muted"><b>Almacén: {{$users_detalles->almacen}} </b>  </p>
							<p class="text-muted"><b>Ciudad: {{$users_detalles->cuidad}}</b>  </p>

              <hr>
              <strong><i class="fa fa-envelope margin-r-5"></i>Correo:<a href="mailto:{{$users_detalles->usuario->email}}">  {{$users_detalles->usuario->email}}</a> </strong>

              <p> </p>

							</div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


        </div>
        <!-- /.col -->

      <!-- /.row -->

    </section>







			</div>
	</div>


@endsection
