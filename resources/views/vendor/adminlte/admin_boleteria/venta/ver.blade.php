@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">

			    <!-- Main content -->
			    <section class="invoice">
			      <!-- title row -->
			      <div class="row">
			        <div class="col-xs-12">
			          <h2 class="page-header">
			            Fondo de Empleados de Sodimac Colombia FONSODI
			            <small class="pull-right">Fecha factura: {{ $date = $venta->created_at->format('d-m-Y') }}</small>
			          </h2>
			        </div>
			        <!-- /.col -->
			      </div>
			      <!-- info row -->
			      <div class="row invoice-info">
			        <div class="col-sm-4 invoice-col">
			          De
			          <address>
			            <strong>FONSODI</strong><br>
			            Cra 28bis No 49a - 07<br>
			            Bogotá<br>
			            Teléfono: 743-6880<br>
			            Correo: fonsodi@homecenter.co
			          </address>
			        </div>
			        <!-- /.col -->
			        <div class="col-sm-4 invoice-col">
			          Para
			          <address>
			            <strong>{{$venta->venta_user->name}}</strong><br>
			             {{$usuario->almacen}}<br>
			            {{$usuario->cuidad}}<br>
									@if(empty($telefonos->numero))
										Teléfono: Sin teléfono<br>
									@else
			            	Teléfono: {{$telefonos->numero}}<br>
									@endif
			            Correo: {{$venta->venta_user->email}}
			          </address>
			        </div>
			        <!-- /.col -->
			        <div class="col-sm-4 invoice-col">
			          <b>Comercial:  </b>  {{$venta->venta_admin->name}}<br>
			          <br>
			          <b>Referencia:</b> {{$venta->referencia}}<br>
								<b>Fecha primer pago:</b> {{\Carbon\Carbon::parse($venta->fecha_primer_pago)->format('d-m-Y')}}<br>
			          <b style="color: #ff4949;" >Transferencia solidaria:</b> <b style="color: #3c8dbc;">${{number_format($ganancia) }}</b><br>

			        </div>
			        <!-- /.col -->
			      </div>
			      <!-- /.row -->

			      <!-- Table row -->
			      <div class="row">
			        <div class="col-xs-12 table-responsive">
			          <table class="table table-striped">
			            <thead>
			            <tr>
			              <th>Producto</th>
			              <th>Serial #</th>
										<th>Proveedor</th>
			              <th>Fecha de caducidad</th>
			              <th>VR/UND</th>
			            </tr>
			            </thead>
			            <tbody>

									@foreach ($venta_detalles as $venta_detalle)
			            <tr>
			              <td>{{$venta_detalle->producto->serial_producto->nombre}}</td>
										<td>{{$venta_detalle->producto->numero}}</td>
			              <td>{{$venta_detalle->producto->serial_producto->producto_provedor->name}}</td>
			              <td>{{\Carbon\Carbon::parse($venta_detalle->producto->fecha_caducidad)->format('d-m-Y')}}</td>
			              <td>${{number_format($venta_detalle->producto->precio_venta)}}</td>
			            </tr>
									@endforeach
			            </tbody>
			          </table>
			        </div>
			        <!-- /.col -->
			      </div>
			      <!-- /.row -->

			      <div class="row">
			        <!-- accepted payments column -->
			        <div class="col-xs-6">

			        </div>
			        <!-- /.col -->
			        <div class="col-xs-6">


			          <div class="table-responsive">
			            <table class="table">
			              <tr>
			                <th style="width:50%">Cuotas:</th>
			                <td>{{$venta->cuota}}</td>
			              </tr>
			              <tr>
			                <th>Total:</th>
			                <td>${{number_format($total)}}</td>
			              </tr>
			            </table>
			          </div>
			        </div>
			        <!-- /.col -->
			      </div>
			      <!-- /.row -->

			      <!-- this row will not appear when printing -->
			      <div class="row no-print">
			        <div class="col-xs-12">

			          <a href="javascript:history.back()" class="btn btn-success pull-right"><i class="fa fa-caret-left"></i> Atrás
			          </a>
			          <a href="{{url('admin_boleteria/vender/ver/pdf/'.$venta->id)}}" class="btn btn-primary pull-right" style="margin-right: 5px;" target="_blank">
			            <i class="fa fa-print"></i> Imprimir
			          </a>
			        </div>
			      </div>
			    </section>
			    <!-- /.content -->
			    <div class="clearfix"></div>









		</div>
	</div>
@endsection
