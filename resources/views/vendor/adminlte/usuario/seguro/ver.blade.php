@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">

		@include('adminlte::usuario.seguro.atras')

		<div class="col-lg-offset-2 col-lg-8">
				 <!-- Widget: user widget style 1 -->
				 <div class="box box-widget widget-user-2">
					 <!-- Add the bg color to the header using any of the bg-* classes -->
					 <div class="widget-user-header bg-blue">

							<i class="fa {{$seguro->seguro_producto->icono}} fa-5x" style="position: absolute;" ></i>
						 <!-- /.widget-user-image -->
						 <h3 class="widget-user-username">{{$seguro->seguro_producto->name}}</h3>
						 <br>
					 </div>
					 <div class="box-footer no-padding">
						 <ul class="nav nav-stacked">
							 <li><a>Radicado: <span class="pull-right">
								 @if($seguro->caso_delima == "")
								 Pendiente de radicación por parte de nuestro corredor de seguros
								 @else
								 {{$seguro->caso_delima}}
								 @endif

								 </span></a></li>
							 <li><a>Historial de estados <span class="pull-right">
								 <ul>
									 @foreach ($estados as $estado)
									 			<li style="list-style:none" ><span class="label label-{{$estado->seguro_estado_aprobacion->estilo}}">{{$estado->seguro_estado_aprobacion->tipo}}<span> - fecha: {{$estado->created_at->format('d-m-Y')}}</li>
									 @endforeach
								 </ul>
								 </span></a></li>

								 <li><a>Documentos anexados a este producto <span class="pull-right">
									<ul>
										@foreach ($segurosarchivos as $segurosarchivo)
											<a href="{{url('seguros/descarga/'.$segurosarchivo->id)}}" download="{{$segurosarchivo->nombre}}" ><i class="fa fa-download" aria-hidden="true"> {{$segurosarchivo->nombre}}</i></a><br>
										@endforeach
									</ul>
									</span></a></li>
						 </ul>
					 </div>
				 </div>
				 <!-- /.widget-user -->
			 </div>





		</div>
	</div>
@endsection
