@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">

			<div class="row">
			  <a href="javascript:history.back()" >
			     <div class="col-md-1">
			         <span class="info-box-icon bg-yellow"><i class="fa fa-chevron-left"></i></span>
			     </div>
			  </a>
			</div><br>

		<div class="col-lg-offset-2 col-lg-8">
				 <!-- Widget: user widget style 1 -->
				 <div class="box box-widget widget-user-2">
					 <!-- Add the bg color to the header using any of the bg-* classes -->
					 <div class="widget-user-header bg-blue">
						 <div class="widget-user-image">
							 <img class="img-circle" src="{{ asset('/img/boleta.jpg') }}" alt="User Avatar">
						 </div>
						 <!-- /.widget-user-image -->
						 <h3 class="widget-user-username">{{$serial->numero}}</h3>
						  <h5 class="widget-user-desc">{{$serial->serial_producto->nombre}}</h5>
					 </div>
					 <div class="box-footer no-padding">
						 <ul class="nav nav-stacked">
							 <li><a>Precio de compra: <span class="pull-right">${{number_format($serial->precio_compra)}}</span></a></li>
							 <li><a>Precio al publico: <span class="pull-right">${{number_format($serial->precio_publico)}}</span></a></li>
							 @if(empty($serial->precio_venta))
							 <li><a>Precio de venta: <span class="pull-right">${{$serial->precio_venta}}</span></a></li>
							 @else
							 <li><a>Precio de venta: <span class="pull-right">${{number_format($serial->precio_venta)}}</span></a></li>
							 @endif
							 <li><a>fecha de caducidad: <span class="pull-right">{{\Carbon\Carbon::parse($serial->fecha_caducidad)->format('d-m-Y')}}</span></a></li>
							 <li><a>Proveedor: <span class="pull-right">{{$serial->serial_producto->producto_provedor->name}}</span></a></li>
							 <li><a>Estados:  <span class="pull-right"></span></a></li>

							  <li><a>	 
								<table class="table table-bordered table-striped">
                  <thead>
                  <tr>
 								 	 <th>Usuario</th>
									 <th>Estado</th>
									 <th>Fecha</th>
                  </tr>
                  </thead>
                  <tbody>
										@foreach($asignaciones as $asignacion)
                  <tr>
										<td>
										{{$asignacion->asignacion_admin_users->name}}
										</td>
 	                   <td>
											 <span class="label label-{{$asignacion->asignacion_estado->estilo}}">{{$asignacion->asignacion_estado->tipo}}</span></a>
										 </td>
										 <td>
 										{{$asignacion->created_at}}
 										</td>
 								 </tr>
								  @endforeach
                  </tfoot>
                </table>
								</a>
								</li>


						 </ul>
					 </div>
				 </div>
				 <!-- /.widget-user -->
			 </div>





		</div>
	</div>
@endsection
