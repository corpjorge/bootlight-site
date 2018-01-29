<head>
    <meta charset="UTF-8">
    <title> Portal </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('/css/all.css') }}" rel="stylesheet" type="text/css" />

<body onload="window.print();">


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
                <b>Radicado:</b> {{$venta->radicado}}<br>
			          <b>Fecha:</b> {{\Carbon\Carbon::parse($venta->fecha_primer_pago)->format('d-m-Y')}}<br>
               {{-- <b>Transferencia solidaria:</b> ${{number_format($ganancia) }}<br>--}}

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
			              <th>Fecha de caducidad</th>
			              <th>VR/UND</th>
			            </tr>
			            </thead>
			            <tbody>

									@foreach ($venta_detalles as $venta_detalle)
			            <tr>
			              <td>{{$venta_detalle->producto->serial_producto->nombre}}</td>
			              <td>{{$venta_detalle->producto->numero}}</td>
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

			    </section>
			    <!-- /.content -->
			    <div class="clearfix"></div>




		</div>
	</div>
	</body>
