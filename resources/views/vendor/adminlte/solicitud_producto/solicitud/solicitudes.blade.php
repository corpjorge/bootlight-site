@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
<section class="content-header">
    <h1>Productos
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</li>
				<li><a href="{{ url('/Productos')}}">Productos</a></li>
    </ol>
</section>
<br>
	<div class="container-fluid spark-screen">
		<div class="row">


					<a href="{{url('solicitudes/productos')}}">
						<div class="col-lg-3 col-xs-6" >
							<div class="small-box bg-teal " style="padding: 11px">
								<div class="inner">
									<h4>Agregar un Productos</h4>
									<p>Clic aquí</p>
								</div>
								<div class="icon">
									<i class="fa fa-codepen "></i>
								</div>
							</div>
						</div>
					</a>

    </div>
	</div>

	@if(session()->has('message'))
                		 <div class="alert alert-success alert-dismissible">
                							 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                							 <h4><i class="icon fa fa-check"></i> Correcto!</h4>
                							 {{session()->get('message')}}
                						 </div>
                		@endif


<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-tag"></i> Estado de Solicitudes</h3>
        </div>
        <div class="box-body">
          <div class="row">

            <a href="{{ url('solicitudes/solicitados/3')}}">
                  <div class="col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-orange"><i class="fa fa-"></i>{{$pendientes}}</span>
                      <div class="info-box-content">
                        <span class="info-box-text">Pendientes</span>
                        <p>Ingresar</p>
                        <small style="font-weight: 300; font-size: 15px; color: #777">Sin Gestion</small>
                      </div>
                    </div>
                  </div>
            </a>

            <a href="{{ url('solicitudes/solicitados/1')}}">
                  <div class="col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-blue"><i class="fa fa-"></i>{{$aprobado}}</span>
                      <div class="info-box-content">
                        <span class="info-box-text">Aprobados</span>
                        <p>Ingresar</p>
                        <small style="font-weight: 300; font-size: 15px; color: #777">Pendientes confirmacion del cliente</small>
                      </div>
                    </div>
                  </div>
            </a>

            <a href="{{ url('solicitudes/solicitados/2')}}">
                  <div class="col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-red"><i class="fa fa-"></i>{{$negados}}</span>
                      <div class="info-box-content">
                        <span class="info-box-text">Negados</span>
                        <p>Ingresar</p>
                        <small style="font-weight: 300; font-size: 15px; color: #777">Negados</small>
                      </div>
                    </div>
                  </div>
            </a>
{{--
            <a href="{{ url('solicitudes/solicitados/6')}}">
                  <div class="col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-aqua"><i class="fa fa-"></i>{{$desembolsados}}</span>
                      <div class="info-box-content">
                        <span class="info-box-text">Desembolsar</span>
                        <p>Ingresar</p>
                        <small style="font-weight: 300; font-size: 15px; color: #777">Confirmados Por el cliente</small>
                      </div>
                    </div>
                  </div>
            </a>
--}}

 
            <a href="{{ url('solicitudes/solicitados-excel')}}">
                  <div class="col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-aqua"><i class="fa fa-download"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Desembolsar (Excel)</span>
                        <p>Ingresar</p>
                        <small style="font-weight: 300; font-size: 15px; color: #777">Confirmados Por el cliente</small>
                      </div>
                    </div>
                  </div>
            </a>

            <a href="{{ url('solicitudes/desembolso')}}">
                  <div class="col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-aqua"><i class="fa fa-"></i>{{$desembolsados}}</span>
                      <div class="info-box-content">
                        <span class="info-box-text">Desembolsar</span>
                        <p>Ingresar</p>
                        <small style="font-weight: 300; font-size: 15px; color: #777">Listos para ser desembolsados</small>
                      </div>
                    </div>
                  </div>
            </a>

            <a href="{{ url('solicitudes/solicitados/5')}}">
                  <div class="col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-green"><i class="fa fa-"></i>{{$vendidos}}</span>
                      <div class="info-box-content">
                        <span class="info-box-text">Entregados</span>
                        <p>Ingresar</p>
                        <small style="font-weight: 300; font-size: 15px; color: #777">Terminados</small>
                      </div>
                    </div>
                  </div>
            </a>

            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>

      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-tag"></i> Descargar</h3>
        </div>
        <div class="box-body">
          <div class="row">

            <div class="col-sm-3 col-xs-12">
               <form role="form" action="{{ url('solicitudes/solicitados-excelEstadoOtro') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                    <div class="box-body">                      
                      <div class="form-group">
                        <label>Estado</label>
                        <select class="form-control" name="estado" required>
                          <option value="">Seleccionar</option>                        
                          <option value="pendiente">Pendiente</option>
                          <option value="aprobado">Aprobado</option>
                          <option value="negado">Negado</option>
                          <option value="desembolsado">Desembolsado</option>
                          <option value="vendido">Vendido</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Fecha</label>
                        <input style="color: black;" type="date" class="form-control" name="fecha" required>
                      </div>
                    </div>
                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">Descargar</button>
                    </div>
            </div>
          </div>
          </div>
          </div>

</section>


@endsection
