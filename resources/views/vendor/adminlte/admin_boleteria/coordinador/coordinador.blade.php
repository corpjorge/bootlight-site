@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')

<section class="content-header">
    <h1>Coordinador
    <small>Asignaciones realizadas</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</li>
		<li><a href="{{ url('/admin_boleteria')}}">Boletería</a></li>
        <li class="active"><a href="#">Coordinador</a></li>
    </ol>
</section>
<br>

	<div class="container-fluid spark-screen">
		<div class="row">



		@if(session()->has('message'))
		 <div class="alert alert-success alert-dismissible">
							 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							 <h4><i class="icon fa fa-check"></i> Correcto!</h4>
							 {{session()->get('message')}}
						 </div>
		@endif

		<div class="box">
             <div class="box-header">
               <h3 class="box-title">Asignaciones</h3>
             </div>
             <!-- /.box-header -->
             <div class="box-body">
               <table id="example" class="table table-bordered table-striped">
                 <thead>
                 <tr>
                   <th>Fecha de caducidad</th>
									 <th>Producto</th>
									 <th>Serial</th>
									 <th>Estado</th>
									 <th>Aprobación</th>

                 </tr>
                 </thead>
                 <tbody>
								 @foreach ($seriales as $serial)
                 <tr>
									 @if(\Carbon\Carbon::parse($serial->fecha_caducidad)->subDay(50) <=  $now = \Carbon\Carbon::now() )
									 	 <td><label class="label label-danger">{{ \Carbon\Carbon::parse($serial->fecha_caducidad)->format('d-m-Y')}} Próximo a vencerse</label></td>
									 @else
										 <td><label class="label label-primary">{{ \Carbon\Carbon::parse($serial->fecha_caducidad)->format('d-m-Y')}} </label></td>
									 @endif
										 <td>{{$serial->serial_producto->nombre}}</td>
										 <td>{{$serial->numero}}</td>
										 <td><span class="label label-{{$serial->serial_estado->estilo}}">{{$serial->serial_estado->tipo}}</span></td>
										 <td>
											 <form action="{{ url('admin_boleteria/coordinador/aprobar/'.$serial->id)}}" method="post" style="display:inline;">
											 <input type="hidden" name="_token" value="{{ csrf_token() }}">
				 							 {{method_field('PUT')}}
											 <button type='submit' style="border: none; background: none; color:#3c8dbc;"><i class="fa fa-fw fa-check"></i>Aprobar</button>
										   </form>

											 <form action="{{ url('admin_boleteria/coordinador/negar/'.$serial->id)}}"   method="post" style="display:inline;">
											 <input type="hidden" name="_token" value="{{ csrf_token() }}">
				 							 {{method_field('PUT')}}
											 <button type='submit' style="border: none; background: none; color: #bc3c3c;"><i class="fa fa-fw fa-close"></i>Negar</button>
											 </form>


								 </tr>
								 @endforeach
                 </tfoot>
               </table>
             </div>
             <!-- /.box-body -->
           </div>

		</div>
	</div>
@endsection
