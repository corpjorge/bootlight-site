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


					<a href="{{route('solicitud.create')}}">
						<div class="col-lg-3 col-xs-6" >
							<div class="small-box bg-teal " style="padding: 11px">
								<div class="inner">
									<h4>Solicita un Producto</h4>
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

                		@if(session()->has('error'))
                		 <div class="alert alert-danger alert-dismissible">
                							 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                							 <h4><i class="icon fa fa-check"></i> Error!</h4>
                							 {{session()->get('error')}}
                						 </div>
                		@endif



	<div class="col-md12">
		<!-- /.box -->
		<!-- TABLE: LATEST ORDERS -->
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Solicitudes</h3>

			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div class="table-responsive">
					<table class="table no-margin">
						<thead>
						<tr>
							<th>Producto</th>
							<th>Monto</th>							
							<th>Meses</th>
							<th>Fecha</th>
							<th>Estado</th>							
							<th>Comprobante</th>							
							<th>Observacion</th>							
							<th> </th>							
						</tr>
						</thead>
						<tbody>
							 
						@foreach($rows as $key)
						<tr>
							<td>{{$key->producto->name}}</td>
							<td>{{$key->monto}}</td>
							<td>{{$key->cuotas}}</td>
							<td>
								<div class="sparkbar" data-color="#00a65a" data-height="20">{{$key->created_at->diffForHumans()}}</div>
							</td>
							<td>
								@if($key->estado->id != 5)
								<span class="label label-{{$key->estado->estilo}}">{{$key->estado->tipo}}</span>
								@else
								<span class="label label-{{$key->estado->estilo}}">Entregado</span>
								@endif
	
							</td>
							<td>
								@if($key->estado->id == 5)
								 <a href="{{url('solicitud/comprobante/'.$key->id)}}">Ver</a>
								@else
								- 
								@endif
							</td>
							<td>{{$key->observacion}}</td>
							<th>
								@if($key->estado->id == 1)
								 <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-default-{{$key->id}}">
                					Confirmar aprobación
              					 </button>
								@endif

								   
                            <form   action="{{ url('solicitud/productos/codigo/'.$key->id) }}" method="post">
                    				    <input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="modal fade" id="modal-default-{{$key->id}}">
						          <div class="modal-dialog">
						            <div class="modal-content">
						              <div class="modal-header">
						                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						                  <span aria-hidden="true">&times;</span></button>
						                <h4 class="modal-title">Confirmar</h4>
						              </div>
						              <div class="modal-body">
						                <p>Ingrese el codigo enviado al correo electrónico</p>
						                <div class="form-group">
				                        <input style="color: black;" type="password" class="form-control" id="codigo" name="codigo" placeholder="xxxxx" min="1" max="6" required>
				                        </form>
				                        <br> 
				                       {{--<small>Reenviar codigo nuevamente clic <a href=""> aquí</a></small>--}}
				                      </div>
						              </div>
						              <div class="modal-footer">
						                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
						                <button type="submit" class="btn btn-primary">Confirmar</button>
						              </div>
						            </div>
						            <!-- /.modal-content -->
						          </div>
						          <!-- /.modal-dialog -->
						        </div>
						     </form>
						        <!-- /.modal -->
							</th>								 
							
						</tr>
						@endforeach 
						</tbody>
					</table>
				</div>
				<!-- /.table-responsive -->
			</div>
			<!-- /.box-body -->
			<div class="box-footer clearfix">
			 {{ $rows->links() }} 
			</div>
			<!-- /.box-footer -->
		</div>
		<!-- /.box -->
	</div>



@endsection
