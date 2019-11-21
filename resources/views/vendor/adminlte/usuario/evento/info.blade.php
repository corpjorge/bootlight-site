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


              <h3 class="box-title">{{$evento->title}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <p class="lead" style="text-align: justify">
								{{$evento->descripcion}}
							</p>
							Ciudad: {{$evento->evento_cuidades->name}}

            </div>
            <!-- /.box-body -->
          </div>


				<a href="{{url('inscripcion')}}" class="btn btn-block btn-warning">Cancelar</a>
				<button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#exampleModal">Asistir a evento</button>

          <!-- /.box -->
        </div>
				<div class="col-md-6">
	          <div class="box box-solid">

	            <!-- /.box-header -->
	            <div class="box-body">
								<?php  $url = Storage::url($evento->img)?>
	             <img src="{{$url}}" style="width: 100%;"  alt="User Image" />
	            </div>

	            <!-- /.box-body -->
	          </div>
	          <!-- /.box -->
	        </div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Términos y condiciones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     {{$evento->condiciones}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<a href="{{url('inscripcion/add/'.$evento->id)}}" class="btn btn-primary">Asistir a evento</a>
      </div>
    </div>
  </div>
</div>

			</div>
	</div>


@endsection
