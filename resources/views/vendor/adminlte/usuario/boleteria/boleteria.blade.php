@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">


					<a href="{{url('boleteria/productos/add')}}">
						<div class="col-lg-3 col-xs-6" >
							<div class="small-box bg-teal " style="padding: 11px">
								<div class="inner">
									<h4>Mira nuestros Productos</h4>
									<p>Clic aquí</p>
								</div>
								<div class="icon">
									<i class="fa fa-ticket "></i>
								</div>
							</div>
						</div>
					</a>

    </div>
	</div>



	<div class="col-md12">
		<!-- /.box -->
		<!-- TABLE: LATEST ORDERS -->
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Compras</h3>

			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div class="table-responsive">
					<table class="table no-margin">
						<thead>
						<tr>
							<th>Referencia</th>
							<th>Vendedor</th>
							<th>Fecha primer pago</th>
							<th>Coutas</th>
							<th>Fecha</th>
						</tr>
						</thead>
						<tbody>
						@foreach($compras as $compra)
						<tr>
							<td><a href="{{url('boleteria/ver/'.$compra->id)}}">{{$compra->referencia}}</a></td>
							<td>{{$compra->venta_admin->name}}</td>
							<td>{{\Carbon\Carbon::parse($compra->fecha_primer_pago)->format('d-m-Y')}}</td>
							<td>{{$compra->cuota}}</td>
							<td>
								<div class="sparkbar" data-color="#00a65a" data-height="20">{{$compra->created_at->diffForHumans()}}</div>
							</td>
						</tr>
						@endforeach
						</tbody>
					</table>
				</div>
				<!-- /.table-responsive -->
			</div>
			<!-- /.box-body -->
			<div class="box-footer clearfix">
			 {{ $compras->links() }}
			</div>
			<!-- /.box-footer -->
		</div>
		<!-- /.box -->
	</div>



@endsection
