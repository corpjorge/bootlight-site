@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			
			 @foreach ($seguro_productos as $seguro_producto)
			 	@if($seguro_producto->seguro_producto_estado->tipo == 'Activado' )
					<a href="{{url($seguro_producto->ruta.'/info/'.$seguro_producto->id)}}">
						<div class="col-lg-3 col-xs-6" >
							<div class="small-box {{$seguro_producto->estilo}}" style="padding: 61px 19px">
								<div class="inner">
									<h4>{{$seguro_producto->name}}</h4>
									<p>Solicitar</p>
								</div>
								<div class="icon" style="top: 43px; right: 20px;">
									<i class="fa {{$seguro_producto->icono}}"></i>
								</div>
							</div>
						</div>
					</a>
				@endif
			@endforeach
    </div>
	</div>

	<!-- <form action="{{url('seguro/add')}}" class="dropzone" id="my-dropzone" file="true" method="post" enctype="multipart/form-data" >
		 <input type="hidden" name="_token" value="{{ csrf_token() }}">
		 <input type="hidden" name="_token" value="{{ csrf_token() }}">
		 <div class="fallback">
			 <input name="file" type="file" multiple />
		 </div>
	</form> -->

@endsection
