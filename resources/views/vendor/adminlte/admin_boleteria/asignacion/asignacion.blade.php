@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<section class="content-header">
    <h1>Asignacion
    <small>Asignaciones realizadas</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</li>
		<li><a href="{{ url('/admin_boleteria')}}">Boletería</a></li>
        <li class="active"><a href="#">Asignacion</a></li>
    </ol>
</section>
<br>

	<div class="container-fluid spark-screen">
		<div class="row">

			<div class="row">
				<a href="{{ url('/admin_boleteria/asignacion/add') }}" >
					 <div class="col-md-1">
							 <span class="info-box-icon bg-aqua"><i class="fa fa-plus"></i></span>
					 </div>
				</a>
			</div><br>

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
									 <th>id</th>
									 <th>Serial</th>
                   <th>Nombre</th>
                   <th>Aprobación</th>
									 <th>Editar</th>
									 <th>Fecha</th>

                 </tr>
                 </thead>
                 <tbody>
								 @foreach ($seriales as $serial)
                 <tr>
									 	  <td>{{$serial->id}}</td>
										 <td><a href="{{url('admin_boleteria/seriales/ver/'.$serial->id)}}" >{{$serial->numero}}</a></td>
										 <td>{{$serial->serial_admin->name}}</td>
										 <td><span class="label label-{{$serial->serial_estado->estilo}}">{{$serial->serial_estado->tipo}}</span></td>
										 <td><a style="cursor: pointer;" data-toggle="modal" data-target="#myModal{{$serial->id}}"><i class="fa fa-fw fa-reply"></i>Revertir</a>
										  <!-- Modal -->
										  <div class="modal fade" id="myModal{{$serial->id}}" role="dialog">
										    <div class="modal-dialog modal-sm">
										      <div class="modal-content">
										        <div class="modal-header">
										          <button type="button" class="close" data-dismiss="modal">&times;</button>
										          <h4 class="modal-title">Confirmar</h4>
										        </div>
										        <div class="modal-body">
										          <p>Esta seguro en realizar esta acción.</p>
										        </div>
										        <div class="modal-footer">
										          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
														 <a href="{{url('admin_boleteria/asignacion/ver/'.$serial->id.'/edit')}}" class="btn btn-primary" >Revertir</a>
										        </div>
										      </div>
										    </div>
										  </div>
									  </td>
										<td>{{$serial->updated_at->diffForHumans()}}</td>
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
