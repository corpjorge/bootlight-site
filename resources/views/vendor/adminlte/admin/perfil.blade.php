@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
<section class="content-header">
    <h1>Perfil
    <small>Detalle</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</li>
		<li><a href="{{ url('/admin_home')}}">Inicio</a></li>
        <li class="active"><a href="#">Perfil</a></li>
    </ol>
</section>
<br>

	<div class="container-fluid spark-screen">
		<div class="row">



<section class="content">

	<!-- Profile Image -->
	<div class="box box-widget widget-user">
		<!-- Add the bg color to the header using any of the bg-* classes -->
		<div class="widget-user-header bg-aqua-active">
			<h3 class="widget-user-username">
				{{Auth::guard('admin_user')->user()->name}}
			</h3>
			<h5 class="widget-user-desc" style="text-transform: capitalize;">{{Auth::guard('admin_user')->user()->rol->name}}</h5>
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
              <p class="text-muted"><b>email:  </b> <a href="mailto:{{Auth::guard('admin_user')->user()->email}}">{{Auth::guard('admin_user')->user()->email}}</a></p>
              <hr>
						  </div>




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
