@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">

			<div class="row">
			  <a href="{{url('admin_boleteria/vender/add')}}" >
			     <div class="col-md-1">
			         <span class="info-box-icon bg-yellow"><i class="fa fa-chevron-left"></i></span>
			     </div>
			  </a>
			</div><br>

					@if ($producto->producto_provedor->linea == 1)
						<form role="form" action="{{ url('admin_boleteria/vender/servicio/'.$producto->id) }}" method="post" name="miform" id="miform">
					@else
						<form role="form" action="{{ url('admin_boleteria/vender/credito/'.$producto->id) }}" method="post" name="miform" id="miform">
					@endif

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


							@if(session()->has('message'))
							 <div class="alert alert-danger alert-danger">
												 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
												 <h4><i class="icon fa fa-check"></i> Error!</h4>
												 {{session()->get('message')}}
											 </div>
							@endif



							<div class="box box-danger">
		            <div class="box-header">
		              <h3 class="box-title">Asociado</h3>
		            </div>
		            <div class="box-body">
									<div class="col-md-2">
										<div class="form-group">
											<label for="cedula">Cedula</label>
											<input style="color:#555555; width: 165px;" type="number" class="form-control" id="cedulaBoletas" name="cedula" placeholder="cedula" min="1">
										</div>
 									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="nombre">Nombre</label>
											<input style="color:#555555; width: 262px;" type="text" class="form-control" id="nombre" disabled>
										</div>
 									</div>

									<div class="col-md-2">
										<div class="form-group">
											<label>Codigo</label>
											<input style="color:#555555; width: 165px;" type="text" class="form-control codigo" disabled>
										</div>
 									</div>
											<input type="hidden" name="codigo"     id="codigo" class="codigo">
											<input type="hidden" name="idAsociado" id="idAsociado">
		            </div>

		            <!-- /.box-body -->
		            <!-- Loading (remove the following to stop the loading)-->
								<div class="overlay" id="cargaAsociado" style="display:none;">
									<i class="fa fa-refresh fa-spin"></i>
								</div>
		            <!-- end loading -->
		          </div>


			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="col-md-6">
						<div class="small-box bg-aqua">
					 <div class="inner" style="font-size: 71PX;" >
						 <input type="number" id="totalBoletas" value="0" style="background: none; border: none;" disabled>
					 </div>
					 </div>
					</div>
					<div class="col-md-6">
						<h2> {{$producto->nombre}}</h2>
				</div>
				</div>

					 <div class="box-body">

<div class="col-md-12">
						 <div class="form-group">
							 <label for="nombre">Numero de cuotas</label>
							 <input style="color:#555555; width: 165px;" type="number" class="form-control" id="cuotas" name="cuotas" placeholder="cuotas" min="1" max="6">
						 </div>
							<div class="panel panel-default">
							  <div class="panel-heading">
							    <h3 class="panel-title">Seriales</h3>
							  </div>
								@foreach ($seriales as $serial)
									 <label style="padding: 3px;" for="{{$serial->numero}}">
											 <ul class="todo-list">
												 <li clase="serialLista">
													 <div style="display:inline;" >
													 <input name="serial[]" type="checkbox" class="serialID" value="{{$serial->id}}" info-Valor="{{$serial->precio_venta}}" id="{{$serial->numero}}">
													 </div>
													 <span class="text">{{$serial->numero}}:</span> <span>${{$serial->precio_venta}}</span>
												 </li>
											 </ul>
									   </label>
								 @endforeach
							</div>

					 <div class="box-footer">
						 <button type="submit" class="btn btn-primary" id="venderBoleta" disabled>Vender</button>
					 </div>
				 </form>
			 </div>
			 </div>

</div>

		</div>
	</div>
@endsection
