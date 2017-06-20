@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<section class="content-header">
    <h1>Seriales No Consecutivo
    <small>Ingreso de seriales no consecutivo</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</li>
		<li><a href="{{ url('/admin_boleteria')}}">Boletería</a></li>
			  <li><a href="{{ url('admin_boleteria/seriales/')}}">Seriales</a></li>
        <li class="active"><a href="#">Ingreso no consecutivo</a></li>
    </ol>
</section>
<br>
	<div class="container-fluid spark-screen">
		<div class="row">

		@include('adminlte::admin_boleteria.seriales.atras')

		<div class="">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Añadir Seriales</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ url('admin_boleteria/seriales/add/no') }}" method="post">
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
							<input type="hidden" name="cantidad" value="{{$cantidad}}">
              <div class="box-body">

								<div class="form-group">
 								 <label for="nombre">Cantidad</label>
 								 <input style="color:#555555" type="number" class="form-control"  value="{{$cantidad}}" disabled>
 							 </div>

								<div class="form-group">
								 <label>Producto</label>
									 <select style="color:#555555" name="producto" class="form-control">
										 	<option></option>
										 @foreach ($productos as $producto)
								 		 	<option style="color:#555555" value="{{$producto->id}}">{{$producto->nombre}}</option>
								 		 @endforeach
									 </select>
							 </div>


							 <div class="form-group">
								 <label>Precio de compra und</label>
								 <input style="color:#555555" type="number" class="form-control" id="Precio_compra" name="precio_compra" placeholder="$ Precio de compra por unidad" >
							 </div>

							 <div class="form-group">
								 <label>Precio al publico und</label>
								 <input style="color:#555555" type="number" class="form-control" id="Precio_publico" name="precio_publico" placeholder="$ Precio al publico por unidad" >
							 </div>


							 <div class="form-group">
								 <label>fecha de caducidad</label>
								 <input style="color:#555555" type="date" class="form-control" id="fecha_caducidad" name="fecha_caducidad" placeholder="fecha de caducidad" >
							 </div>

							 @for ($i = 0; $i < $cantidad; $i++)
							 <div class="form-group">
								 <label for="nombre">Serial Número {{ $i }}</label>
								 <input style="color:#555555" type="text" class="form-control" id="nombre" name="numero[]" placeholder="Serial" onkeypress="return handleEnter(this, event)" required >
							 </div>
							 @endfor

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form>
          </div>

		</div>

		<script type="text/javascript">
		function handleEnter (field, event) {
			var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
			if (keyCode == 13) {
				var i;
				for (i = 0; i < field.form.elements.length; i++)
					if (field == field.form.elements[i])
						break;
				i = (i + 1) % field.form.elements.length;
				field.form.elements[i].focus();
				return false;
			}
			else
			return true;
		}
		</script>





		</div>
	</div>
@endsection
