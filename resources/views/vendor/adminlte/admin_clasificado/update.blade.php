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


		<div class="">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Actualizar Clasificado</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ url('admin_servicios/clasificados/'.$clasificado->id)}}" method="post">
							@if (count($errors) > 0)
			            <div class="alert alert-danger">
			                <strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
			                <ul>
			                    @foreach ($errors->all() as $error)
			                        <li>{{ $error }}</li>
			                    @endforeach
			                </ul>
			            </div>
			        @endif

							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							{{method_field('PUT')}}
              <div class="box-body">

								 <div class="form-group">
									 <label for="exampleInputEmail1">Titulo</label>
									 <input style="color: black;" type="text" class="form-control" id="titulo" name="titulo" value="{{$clasificado->titulo}}" placeholder="Nombre de la publicación">
								 </div>
							 <div class="form-group">
								 <label>Descripción</label>
								 <textarea style="color: black;"   class="form-control" rows="3" name="descripcion" placeholder="Descripción de la publicación">{{$clasificado->descripcion}}</textarea>
							 </div>
							 <div class="form-group">
								 <label>Datos de contacto</label>
								 <textarea style="color: black;" class="form-control" rows="3" name="contacto" placeholder="Telefono - correo - Direccion ">{{$clasificado->contacto}}</textarea>
							 </div>
							 <?php  $url = Storage::url($clasificado->imagen)?>
							 <div class="form-group">
							  	<img src="{{ url($url)}}" width="400px">
							 </div>

							 <div class="form-group">
								<label>Estado</label>
									<select style="color:#555555" name="estado" class="form-control">
										 <option style="color:#555555" value="{{$clasificado->clasificado_estado->id}}">{{$clasificado->clasificado_estado->tipo}}</option>
										 @foreach($estados as $estado)
										 <option style="color:#555555" value="{{$estado->id}}">{{$estado->tipo}}</option>
										 @endforeach
									</select>
							</div>

							<div class="form-group">
								<label for="exampleInputEmail1">Observación</label>
								<input style="color: black;" type="text" class="form-control" id="observacion" name="observacion"  placeholder="Comentario">
							</div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form>
          </div>

		</div>






		</div>
	</div>
@endsection
