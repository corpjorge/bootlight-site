@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<section class="content-header">
    <h1>Catalogo
    <small>Realiza las ventas ingresando el número de cedula del asociado</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</li>
		<li><a href="{{ url('/admin_boleteria')}}">Boletería</a></li>
        <li class="active"><a href="#">Vender</a></li>
    </ol>
</section>
<br>
	<div class="container-fluid spark-screen">
		<div class="row">

			<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="{{ url('admin_boleteria/vender')}}" class="info-box-icon bg-yellow" style="border: none;" ><i class="fa fa-chevron-left"></i></a>

        </div>
			 </div>
			</form>
			<br>


 @foreach ($productos as $producto)
  @if($producto->producto_provedor->nit) 
	 <div class="col-lg-2 col-xs-6">
		 <div class="small-box bg-aqua">
			 <center>
			 <div class="inner">  <br>
				 <p>{{$producto->nombre}}</p>
					 <?php $serialesCantidad = 0; ?>
					 @foreach ($seriales as $serial)
						 @if($serial->serial_producto->nombre == $producto->nombre )
							 <p>
								 <?php $serialesCantidad = $serialesCantidad+count($serial); ?>
							 </p>
						 @endif
						@endforeach
						Cantidad: {{$serialesCantidad}}
			  </div>
			</center>
			@if ($serialesCantidad)
				<a href="{{ url('admin_boleteria/vender/add/'.$producto->id)}}" class="small-box-footer">
					Entrar <i class="fa fa-arrow-circle-right"></i>
				</a>
			@else
				<a class="small-box-footer">Agotado</a>
			@endif
			</div>
		</div>

  @endif
@endforeach






	</div>
@endsection
