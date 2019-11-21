@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">

				<section class="content">
					<div class="row">
						<div class="col-md-12">
							<!-- BAR CHART -->
							<div class="box box-success">
								<div class="box-header with-border">
									<h3 class="box-title">Usuarios (Inventario VS Ventas)</h3>
								</div>
								<div class="box-body">
									<div class="chart">
										<canvas id="barChart" style="height:230px"></canvas>
									</div>
								</div>
								<!-- /.box-body -->
							</div>
							<!-- /.box -->
						</div>
						<div class="col-md-6">
							<!-- DONUT CHART -->
							<div class="box box-danger">
								<div class="box-header with-border">
									<h3 class="box-title">Ventas por producto</h3>
								</div>
								<div class="box-body">
									<canvas id="pieChart" style="height:250px"></canvas>
								</div>
								<!-- /.box-body -->
							</div>
							<!-- /.box -->
						</div>

						<div class="col-md-6">
							<!-- DONUT CHART -->
							<div class="box box-danger">
								<div class="box-header with-border">
									<h3 class="box-title">Descargar Excel</h3>
								</div>


								@if(session()->has('error'))
								 <div class="alert alert-danger alert-dismissible">
													 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
													 {{session()->get('error')}}
												 </div>
								@endif



								<div class="box-body">
									<a href="{{url('admin_boleteria/inventario/excel/ventas')}}" class="btn btn-success"><i class="fa fa-fw fa-file-excel-o"></i> Ventas</a>
									<a href="{{url('admin_boleteria/inventario/tenencia')}}" class="btn btn-success"><i class="fa fa-fw fa-file-excel-o"></i> Inventario</a>
								</div>
								<!-- /.box-body -->
							</div>
							<!-- /.box -->
						</div>
						<!-- /.col (LEFT) -->
					</div>
			  <!-- /.row -->
		   </section>

		</div>
	</div>

@endsection
