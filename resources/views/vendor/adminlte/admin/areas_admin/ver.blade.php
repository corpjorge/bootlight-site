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
		<div class="col-lg-offset-2 col-lg-8">
				 <!-- Widget: user widget style 1 -->
				 <div class="col-lg-3 col-xs-6">
 					<div class="small-box bg-navy">
 						<div class="inner">
 							<h4>ESTADO DE CUENTA</h4>
 							<p>Módulo de atención</p>
 						</div>
 						<div class="icon">
 							<i class="fa fa-user"></i>
 						</div>
 						<a href="{{ url('atencion') }}"class="small-box-footer">Ingresar <i class="fa fa-arrow-circle-right"></i></a>
 					</div>
 				</div>
				 <!-- /.widget-user -->
			 </div>





		</div>
	</div>
@endsection
