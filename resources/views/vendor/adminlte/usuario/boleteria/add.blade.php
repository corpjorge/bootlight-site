@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<section class="content-header">
    <h1>Boletería
    <small>Solicitud de boletas</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</li>
				<li><a href="{{ url('/boleteria')}}">Boletería</a></li>
				<li class="active"><a href="#">Solicitud</a></li>
    </ol>
</section>
<br>
	<div class="container-fluid spark-screen">
		<div class="row">

		<div class="row">
			<a href="{{url('boleteria')}}" >
         <div class="col-md-1">
             <span class="info-box-icon bg-yellow"><i class="fa fa-chevron-left"></i></span>
         </div>
			</a>
    </div><br>


		<form role="form" action="{{ url('boleteria/productos/add') }}" method="post">
			@if (count($errors) > 0)
					<div class="alert alert-danger">
							 {{ trans('adminlte_lang::message.someproblems') }}<br><br>
							<ul>
									@foreach ($errors->all() as $error)
											<li>Seleccione por lo menos un producto</li>
									@endforeach
							</ul>
					</div>
			@endif

			@if(session()->has('message'))
			 <div class="alert alert-success alert-dismissible">
								 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								 <i class="icon fa fa-check"></i>{{session()->get('message')}}
							 </div>
			@endif
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="box box-primary">
		            <div class="box-header">
		              <i class="ion ion-clipboard"></i>
		              <h3 class="box-title">Productos disponibles </h3>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
									<span> Seleccione alguno de los productos que desea adquirir y uno de nuestros asesores se comunicara con usted para que pueda realizar la compra de sus boletas  </span><br><br>

									@foreach($productos as $producto)
									<label for="{{$producto->nombre}}" style="width: 100%;">
										 <ul class="todo-list">
				                <li>
					                  <input name="producto[]" id="{{$producto->nombre}}" type="checkbox" value="{{$producto->nombre}}">
					                  <span class="text">{{$producto->nombre}}</span>
				                </li>
			              </ul>
									</label>
									@endforeach
		            </div>
								<div class="box-footer clearfix no-border">
									<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Solicitar</button>
								</div>
		            <!-- /.box-body -->
		          </div>
				</form>

		</div>
	</div>
@endsection
