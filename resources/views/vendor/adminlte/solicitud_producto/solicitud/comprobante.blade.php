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
			          {{-- <small class="pull-right">Fecha factura: {{ $date = $venta->created_at->format('d-m-Y') }}</small> --}}
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
			            <strong>{{$row->user->name}}</strong><br>
			 	
			            Correo:  {{$row->user->email}}
			          </address>
			        </div>
			        <!-- /.col -->
			        <div class="col-sm-4 invoice-col">
			        
			          <br>				
							
			      

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
			              <th>Monto</th>
						  <th>Meses</th>			              
			            </tr>
			            </thead>
			            <tbody>	 
			            <tr>
			              <td>{{$row->producto->name}}</td>
			              <td>{{$row->monto}}</td>
			              <td>{{$row->cuotas}}</td>
			            </tr>
						 
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
@endsection
