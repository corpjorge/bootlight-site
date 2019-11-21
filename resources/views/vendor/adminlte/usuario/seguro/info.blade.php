@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">

			<div class="col-md-6">
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa {{$seguro_producto->icono}}"></i>

              <h3 class="box-title">{{$seguro_producto->name}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <p class="lead" style="text-align: justify">
								{{$seguro_producto->info}}
							</p>

							<h4 class="box-title"><b>Importante: Documentos a descargar y anexar</b></h4>
							<p class="lead" style="text-align: justify">
								<ul>
									@foreach($seg_documentos as $seg_documento)
									@if($seg_documento->tipo != NULL)
									<a href="{{ asset('documentos/seguros/'.$seguro_producto->name.'/'.$seg_documento->nombre.'.'.$seg_documento->tipo) }}" download><li style="color: Blue;" >{{$seg_documento->nombre}}</li> Descargar</a>
									@else
									<li>Anexar: {{$seg_documento->nombre}}</li>
									@endif

									@endforeach

								</ul>
							</p>


            </div>
            <!-- /.box-body -->
          </div>


				<a href="{{url('seguros/solicitar')}}" class="btn btn-block btn-warning">Cancelar</a>
				<button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#exampleModal">Adquirir producto</button>

          <!-- /.box -->
        </div>
				<div class="col-md-6">
	          <div class="box box-solid">

	            <!-- /.box-header -->
	            <div class="box-body">
	             <img src="{{ asset('img/seguros/'.$seguro_producto->img) }}" style="width: 100%;"  alt="User Image" />
	            </div>
	            <!-- /.box-body -->
	          </div>
	          <!-- /.box -->
	        </div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
			 <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adquirir producto {{$seguro_producto->name}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Desea adquirir el producto {{$seguro_producto->name}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<a href="{{url('seguros/solicitar/terminos/'.$seguro_producto->id)}}" class="btn btn-primary">Adquirir producto</a>
      </div>
    </div>
  </div>
</div>

			</div>
	</div>


@endsection
