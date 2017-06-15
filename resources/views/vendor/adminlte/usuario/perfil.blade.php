@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">


@foreach ($users_detalles as $users_detalle)

<section class="content">

	<!-- Profile Image -->
	<div class="box box-widget widget-user">
		<!-- Add the bg color to the header using any of the bg-* classes -->
		<div class="widget-user-header bg-aqua-active">
			<h3 class="widget-user-username">
				@if(Auth::user()->social_name == '')
				{{ Auth::user()->name }}
				@else
				{{ Auth::user()->social_name }}
				@endif
			</h3>
			<h5 class="widget-user-desc" style="text-transform: capitalize;">{{$users_detalle->usuario->usuario_rol->name}}</h5>
		</div>
		<div class="widget-user-image">
			@if(Auth::user()->avatar == '')
			 @if($users_detalle->genero == 'M')
				<img class="img-circle" src="{{ asset('/img/avatar5.png') }}" alt="User Avatar">
			 @else
			  <img class="img-circle" src="{{ asset('/img/avatar2.png') }}" alt="User Avatar">
			 @endif
			@else
			<img class="img-circle" src="{{ Auth::user()->avatar }}" alt="User Avatar">
			@endif
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

              <p class="text-muted"><b>Fecha de nacimiento: </b> {{$users_detalle->fecha_nacimiento}}</p>
							<p class="text-muted"><b>Fecha de vinculación: </b> {{$users_detalle->fecha_vinculacion}}</p>
							<p class="text-muted"><b>Genero: </b> {{$users_detalle->genero}}</p>
							<p class="text-muted"><b>Estado civil: </b> {{$users_detalle->usuario_estado_civil->tipo}}</p>


              <hr>
</div>
              <strong><i class="fa fa-map-marker margin-r-5"></i> Ubicación</strong>

              <p class="text-muted"><b>Almacén: </b> {{$users_detalle->almacen}}</p>
							<p class="text-muted"><b>Ciudad: </b> {{$users_detalle->cuidad}}</p>

              <hr>
              <strong><i class="fa fa-file-text-o margin-r-5"></i> Hobby </strong>
              <p>{{$users_detalle->hobby}}</p>

							</div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


        </div>
        <!-- /.col -->

      <!-- /.row -->

    </section>


@endforeach




			</div>
	</div>


@endsection
