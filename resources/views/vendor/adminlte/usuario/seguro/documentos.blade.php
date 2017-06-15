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
              <i class="fa {{$segurouser->id}}"></i>

              <h3 class="box-title" style="font-size: 16px;">Documentos solicitados para seguro de <b>{{$segurouser->seguro_producto->name}}</b></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <p class="lead" style="text-align: justify; font-size: 17px;">
								{{$segurouser->observacion_general}}
							</p>

							<h4 class="box-title"><b>Importante: Documentos a descargar y anexar</b></h4>
							<p class="lead" style="text-align: justify">
								<ul>
									@foreach($seg_documentos as $seg_documento)
									@if($seg_documento->tipo != NULL)
									<a href="{{ asset('documentos/seguros/'.$segurouser->seguro_producto->name.'/'.$seg_documento->nombre.'.'.$seg_documento->tipo) }}" download><li style="color: Blue;" >{{$seg_documento->nombre}}</li> Descargar</a>
									@else
									<li>Anexar: {{$seg_documento->nombre}}</li>
									@endif

									@endforeach

								</ul>
							</p>
								<a href="{{url('seguros')}}" class="btn btn-block btn-warning">
									<i class="fa fa-fw fa-arrow-left"></i>
									Devolverse</a>

            </div>
            <!-- /.box-body -->
          </div>



          <!-- /.box -->
        </div>


				<div class="col-md-6">
						<div class="box box-solid">
							<div class="box-header with-border">
								<h3 class="box-title">Nota</h3>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<p class="lead" style="text-align: justify; font-size: 15px;">
									Para realizar el ingreso de documentación arrastre los archivos o
									de clic sobre el recuadro blanco; puede seleccionar varios archivos
									a la vez en formato <b style="color: red;">PDF</b> y <b style="color: blue;">JPG</b>.
								</p>




							</div>
							<!-- /.box-body -->
						</div>



						<!-- /.box -->
					</div>

			<div class="col-md-12">
				<form action="{{url('seguros/solicitar/'.$segurouser->id)}}" class="dropzone" id="my-dropzone" method="post" enctype="multipart/form-data" >
					 <input type="hidden" name="_token" value="{{ csrf_token() }}">
					 {{method_field('PUT')}}
					 <div class="fallback">
						 <input name="file" type="file" multiple />
					 </div><button id="submit-all" class="btn btn-success"><i class="fa fa-fw fa-upload"></i> Subir archivos</button>
			  </form>
        </div>

			</div>
	</div>

	<script type="text/javascript">

   Dropzone.options.myDropzone = {

   // Prevents Dropzone from uploading dropped files immediately
   autoProcessQueue: false,

   init: function() {
     var submitButton = document.querySelector("#submit-all")
         myDropzone = this; // closure

     submitButton.addEventListener("click", function(e) {
			 e.preventDefault();
			 e.stopPropagation();
       myDropzone.processQueue(); // Tell Dropzone to process all queued files.
     });

     // You might want to show the submit button only when
     // files are dropped here:
     this.on("addedfile", function() {
       // Show submit button here and/or inform user to click it.
     });
/*
		 this.on("complete", function(file) {
        myDropzone.removeFile(file);
     });
*/
   }
 };
 </script>

@endsection
