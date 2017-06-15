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

	<!-- Profile Image -->
	<div class="box box-widget widget-user">
		<!-- Add the bg color to the header using any of the bg-* classes -->
		<div class="widget-user-header bg-aqua-active">
			<h3 class="widget-user-username">
				{{$admin->name}}
			</h3>
			<h5 class="widget-user-desc" style="text-transform: capitalize;">{{$admin->rol->name}}</h5>
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
              <p class="text-muted"><b>email:  </b> <a href="mailto:{{$admin->email}}">{{$admin->email}}</a></p>
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
