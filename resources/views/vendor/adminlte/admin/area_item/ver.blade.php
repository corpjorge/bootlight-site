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
				 <div class="box box-widget widget-user-2">
					 <!-- Add the bg color to the header using any of the bg-* classes -->
					 <div class="widget-user-header bg-blue">
						 <div class="widget-user-image">
							 <img class="img-circle" src="{{ asset('/img/avatar0.png') }}" alt="User Avatar">
						 </div>
						 <!-- /.widget-user-image -->
						 <h3 class="widget-user-username">{{$area_item->name}}</h3>
						 <br>
					 </div>
					 <div class="box-footer no-padding">
						 <ul class="nav nav-stacked">
							 {{-- <li><a>AAAAAAAAAAAAAAAAAAAA<span class="pull-right">{{AAAAAAAAAAAAAAAAAAAA->AAAAAAAAAAAAAAAAAAAA}}</span></a></li>
							 <li><a>AAAAAAAAAAAAAAAAAAAA<span class="pull-right">{{AAAAAAAAAAAAAAAAAAAA->AAAAAAAAAAAAAAAAAAAA}}</span></a></li> --}}
						 </ul>
					 </div>
				 </div>
				 <!-- /.widget-user -->
			 </div>





		</div>
	</div>
@endsection
