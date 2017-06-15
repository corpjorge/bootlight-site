@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">

		@include('adminlte::admin_boleteria.informe.atras')

		<div class="col-md-12">


			<!-- /.box -->


			<!-- TABLE: LATEST ORDERS -->
			<div class="box box-info">
				<div class="box-header with-border">
					<h3 class="box-title">Ventas a <a href="{{url('datos_usuario/'.$user->usuario->id)}}"> {{$user->usuario->name}} </a></h3>

				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
						<table class="table no-margin">
							<thead>
							<tr>
								<th>Coordinador</th>
								<th>Referencia</th>
								<th>Fecha primer pago</th>
								<th>Fecha solicitud</th>
							</tr>
							</thead>
							<tbody>
							@foreach($ventas as $venta)
							<tr>
								<td><a href="{{url('datos_admin/'.$venta->admin_user_id)}}">{{$venta->venta_admin->name}}</a></td>
								<td><a href="{{url('admin_boleteria/vender/ver/'.$venta->id)}}">{{$venta->referencia}}</a></td>
								<td>{{$venta->fecha_primer_pago}}</td>
								<td>{{$venta->created_at->diffForHumans()}}</td>
							</tr>
							@endforeach
							</tbody>
						</table>
					</div>
					<!-- /.table-responsive -->
				</div>
				<!-- /.box-body -->
				<div class="box-footer clearfix">
				 {{ $ventas->links() }}
				</div>
				<!-- /.box-footer -->
			</div>
			<!-- /.box -->
		</div>




		</div>
	</div>
@endsection
