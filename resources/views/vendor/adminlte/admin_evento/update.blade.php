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
              <h3 class="box-title">Actualizar evento</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ url('admin_evento/'.$evento->id) }}" method="post" enctype="multipart/form-data">
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
                  <label for="exampleInputPassword1">Nombre</label>
                  <input style="color:#555555" value="{{$evento->name}}" type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del Evento">
                </div>

								<div class="form-group">
                  <label for="exampleInputPassword1">Fecha inicio</label>
                  <input style="color:#555555" value="{{$evento->fecha_inicial}}" type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" >
                </div>

								<div class="form-group">
                  <label for="exampleInputPassword1">Fecha terminacio</label>
                  <input style="color:#555555" value="{{$evento->fecha_final}}" type="date" class="form-control" id="fecha_final" name="fecha_final" >
                </div>

								<div class="form-group">
 								 <label>Descripción</label>
 								 <textarea style="color: black;"   class="form-control" rows="3" name="descripcion" placeholder="Descripción del evento">{{$evento->descripcion}}</textarea>
 							 </div>

							 <div class="form-group">
								<label>Términos y condiciones</label>
								<textarea style="color: black;"   class="form-control" rows="3" name="condiciones" placeholder="Terminos y condiciones">{{$evento->condiciones}}</textarea>
							</div>

							<div class="form-group">
								<label for="exampleInputFile">Imagen </label>
								<input name="file" type="file" id="file" accept="image/jpeg">
								<p class="help-block">Imagen JPG de (500 x 500px).</p>
							</div>

								<div class="form-group">
								 <label>Ciudad</label>
									 <select style="color:#555555" name="ciudad" class="form-control">
										 	<option value="{{$evento->evento_cuidades->id}}">{{$evento->evento_cuidades->name}}</option>
										 @foreach ($ciudades as $ciudad)
								 		 	<option style="color:#555555" value="{{$ciudad->id}}">{{$ciudad->name}}</option>
								 		 @endforeach
									 </select>
							 </div>

							 <div class="form-group">
								<label>Estado</label>
									<select style="color:#555555" name="estado" class="form-control">
										 <option></option>
										@foreach ($estados as $estado)
										 <option style="color:#555555" value="{{$estado->id}}">{{$estado->tipo}}</option>
										@endforeach
									</select>
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
