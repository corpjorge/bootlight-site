@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">


		<section class="content">
			      <!-- Info boxes -->
			<div class="row">

				<div class="col-md-4">
	                
								@if ($inventario < 30)
					<div class="info-box bg-red">
									<?php $mensajeinv = 'Solicita más boletas'; ?>
								@elseif($inventario <= 50)
						<div class="info-box bg-yellow">
									<?php $mensajeinv = 'Tienes tu inventario al 50%'; ?>
								@else
    						<div class="info-box bg-green">
    									<?php $mensajeinv = ''; ?>
    								@endif
    
    			            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
    
    			                <div class="info-box-content">
    			                    <span class="info-box-text">Inventario</span>
    			                    <span class="info-box-number">{{$inventario}}</span>
    
    			                    <div class="progress">
    			                        <div class="progress-bar" style="width: {{$inventario}}%"></div>
    			                    </div>
    			                        <span class="progress-description">
    			                        {{$mensajeinv}}
    			                        </span>
    			                </div>
    			            
    			          </div>
 					</div>

			      

			      
			        <div class="clearfix visible-sm-block"></div>

			        <div class="col-md-3 col-sm-6 col-xs-12">
			            <div class="info-box">
			                <span class="info-box-icon bg-blue"><i class="ion ion-ios-cart-outline"></i></span>

    			            <div class="info-box-content">
    			              <span class="info-box-text">Ventas</span>
    			              <span class="info-box-number">{{$ventatotal}}</span>
    			            </div>
			           
			          </div>
			         
			        </div>
			       
							@if($pendientes > 0)
			        <div class="col-md-3 col-sm-6 col-xs-12">
			            <div class="info-box">
									@if(Auth::guard('admin_user')->user()->role_id <= 3)
			                <a href="{{url('admin_boleteria/asignacion')}}"><span class="info-box-icon bg-yellow"><i class="ion ion-ios-flag-outline"></i></span></a>
									@else
									<a href="{{url('admin_boleteria/coordinador')}}"><span class="info-box-icon bg-yellow"><i class="ion ion-ios-flag-outline"></i></span></a>
									@endif
    			            <div class="info-box-content">
    			              <span class="info-box-text">Sin aprobar</span>
    			              <span class="info-box-number">{{$pendientes}}</span>
    			            </div>
			            
			            </div>
    			          
			        </div>
							@endif
			       
			      </div>

			      <div class="row">
			        <div class="col-md-12">
			          <div class="box">
			            <div class="box-header with-border">
			              <h3 class="box-title">Ventas al año</h3>


			            </div>
			          
			            <div class="box-body">
			              <div class="row">
			                <div class="col-md-12">
			                  <p class="text-center">
			                    <strong>Ventas año: {{$ano}}</strong>
			                  </p>

			                  <div class="chart">
			                   
			                    <canvas id="salesChart" style="height: 180px;"></canvas>
			                  </div>
			                 
			                </div>
			                
			              
			              </div>
			             
			            </div>
			           
			            <div class="box-footer">
			              <div class="row">
			                <div class="col-sm-3 col-xs-6">
			                  <div class="description-block border-right">
			                    <h5 class="description-header">${{$valorventas}}</h5>
			                    <span class="description-text">Total venta</span>
			                  </div>
			                 
			                </div>
			               
			                <div class="col-sm-3 col-xs-6">
			                  <div class="description-block border-right">
			                    <h5 class="description-header">${{$valorcompra}}</h5>
			                    <span class="description-text">TOTAL COSTO</span>
			                  </div>
			                
			                </div>
			              
			                <div class="col-sm-3 col-xs-6">
			                  <div class="description-block border-right">
			                    <h5 class="description-header">${{$ahorroasociados}}</h5>
			                    <span class="description-text">Ahorro a los asociados</span>
			                  </div>
			                
			                </div>
			             
			                <div class="col-sm-3 col-xs-6">
			                  <div class="description-block">
			                    <h5 class="description-header">{{$ahorrofondo}}</h5>
			                    <span class="description-text">Ganancias fondo</span>
			                  </div>
			                 
			                </div>
			              </div>
			            
			            </div>
			           
			          </div>
			        
			        </div>
			       
			      </div>
			     

			   
			      <div class="row">
			       
			        <div class="col-md-8">
			        
			          <div class="box box-info">
			            <div class="box-header with-border">
			              <h3 class="box-title">Ventas</h3>

			            </div>
			          
			            <div class="box-body">
			              <div class="table-responsive">
			                <table class="table no-margin">
			                  <thead>
			                  <tr>
			                    <th>Referencia</th>
			                    <th>Asociado</th>
			                    <th>Fecha</th>
			                  </tr>
			                  </thead>
			                  <tbody>
			                      @foreach($ventatablas as $ventatabla)
                                    <tr>
                                        <td><a href="{{url('admin_boleteria/vender/ver/'.$ventatabla->id)}}">{{$ventatabla->referencia}}</a></td>
        			                    <td><a href="{{url('datos_usuario/'.$ventatabla->venta_user->id)}}">{{$ventatabla->venta_user->name}}</a></td>
        			                    <td>
        			                      <div class="sparkbar" data-color="#00a65a" data-height="20">{{$ventatabla->created_at->diffForHumans()}}</div>
        			                    </td>
			                        </tr>
							        @endforeach
			                  </tbody>
			                </table>
			              </div>
			             
			            </div>
			          
			            <div class="box-footer clearfix">
			                {{ $ventatablas->links() }}
			            </div>
			          
			          </div>
			         
			        </div>
			       

							<div class="col-md-4">
								<div class="box box-info">
			            <div class="box-header with-border">
			              <h3 class="box-title">Buscador</h3>
			            </div>
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
									@if(session()->has('error'))
									 <div class="alert alert-danger alert-dismissible">
														 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
														 {{session()->get('error')}}
													 </div>
									@endif
			            <!-- /.box-header -->
			            <!-- form start -->
			            <form class="form-horizontal" action="{{ url('admin_boleteria/buscar/cedula') }}" method="post" >
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
			              <div class="box-body">
			                <div class="form-group">
			                  <label for="inputEmail3" class="col-sm-2 control-label">Cedula</label>
			                  <div class="col-sm-10">
			                    <input type="number" class="form-control" id="cedula" name="cedula" placeholder="Numero cedula">
			                  </div>
			                </div>
			              </div>

										<div class="box-footer">
			                <button type="submit" class="btn btn-info pull-right">Buscar cedula</button>
			              </div>
									 </form>

										 <form class="form-horizontal" action="{{ url('admin_boleteria/buscar/referencia') }}" method="post">
											 <input type="hidden" name="_token" value="{{ csrf_token() }}">
											<div class="box-body">
				                <div class="form-group">
				                  <label for="inputEmail3" class="col-sm-2 control-label">Referencia</label>
				                  <div class="col-sm-10">
				                    <input type="text" class="form-control" id="referencia" name="referencia" placeholder="Referencia">
				                  </div>
				                </div>
				              </div>
			              <!-- /.box-body -->
				              <div class="box-footer">
				                <button type="submit" class="btn btn-info pull-right">Buscar referencia</button>
				              </div>
				              <!-- /.box-footer -->
				            </form>

										<form class="form-horizontal" action="{{ url('admin_boleteria/buscar/serial') }}" method="post">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
										 <div class="box-body">
											 <div class="form-group">
												 <label for="inputEmail3" class="col-sm-2 control-label">Serial</label>
												 <div class="col-sm-10">
													 <input type="text" class="form-control" id="serial" name="serial" placeholder="Serial">
												 </div>
											 </div>
										 </div>
									 <!-- /.box-body -->
										 <div class="box-footer">
											 <button type="submit" class="btn btn-info pull-right">Buscar serial</button>
										 </div>
										 <!-- /.box-footer -->
									 </form>

			          </div>

							</div>
			        <!-- /.col -->
			      </div>
			      <!-- /.row -->
			    </section>


		</div>
	</div>
@endsection
