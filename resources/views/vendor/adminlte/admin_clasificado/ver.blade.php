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
				 <div class="box box-widget widget-user-2"><h3>{{$clasificado->titulo}}</h3>
					 <!-- Add the bg color to the header using any of the bg-* classes -->
					 <div class="widget-user-header bg-green">
						 <?php  $url = Storage::url($clasificado->imagen)?>
						  <img src="{{$url}}" width="400px">
					 </div>
					 <div class="box-footer no-padding">
						 <ul class="nav nav-stacked">
							 <li><a>{{$clasificado->descripcion}}</a></li>
							 <li><a>{{$clasificado->contacto}}</a></li>
						 </ul>
					 </div>
				 </div>
				 <!-- /.widget-user -->
			 </div>





		</div>
	</div>
@endsection
