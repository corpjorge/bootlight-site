@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">



		<div class="row">
			<a href="{{url('admin_boleteria/proveedores/add')}}" >
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
               <h3 class="box-title">Proveedores</h3>
             </div>
             <!-- /.box-header -->
             <div class="box-body">
               <table id="example" class="table table-bordered table-striped">
                 <thead>
                 <tr>
									 <th>Codigo</th>
									 <th>Nombre</th>
                   <th>Editar</th>
                   <th>Eliminar</th>
									 <th>Fecha</th>
                 </tr>
                 </thead>
                 <tbody>
								 @foreach ($proveedores as $proveedor)
                 <tr>
	                   <td>{{$proveedor->id}}</td>
										 <td><a href="{{url('admin_boleteria/proveedores/ver/'.$proveedor->id)}}" >{{$proveedor->nombre}}</a></td>
										 <td>{{$proveedor->proverdor_tipo_documento->tipo}}: {{$proveedor->numero}}</td>
										 <td><a href="{{url('admin_boleteria/proveedores/ver/'.$proveedor->id.'/edit')}}" >
											  <i class="fa fa-fw fa-edit"></i>Editar</a>
										 </td>
										 <td><a style="cursor: pointer;" data-toggle="modal" data-target="#eliminar{{$proveedor->id}}">
 												<i class="fa fa-fw fa-edit"></i>Eliminar</a>

												<div id="eliminar{{$proveedor->id}}" class="modal fade" role="dialog">
	 										  <div class="modal-dialog">
	 										    <div class="modal-content">
	 													<form action="{{url('admin_boleteria/proveedores/'.$proveedor->id)}}" method="post" >
	 	 												 <input type="hidden" name="_token" value="{{ csrf_token() }}">
	 	 												 {{method_field('DELETE')}}
	 										      <div class="modal-header">
	 										        <button type="button" class="close" data-dismiss="modal">&times;</button>
	 										        <h4 class="modal-title">Confirmar</h4>
	 										      </div>
	 										      <div class="modal-body">
	 										        <p>Desea Borrar el proveedor "<b>{{$proveedor->nombre}}</b>" con
	 															"<b>{{$proveedor->proverdor_tipo_documento->tipo}}</b>"
	 																numero "<b>{{$proveedor->numero}}</b>".</p>
	 										      </div>
	 										      <div class="modal-footer">
	 														<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	 										        <button type="submit" class="btn btn-primary" >Eliminar</button>
	 										      </div>
	 													</form>
	 										    </div>
	 										  </div>
	 										</div>

 										 </td>
										 <td>{{$proveedor->created_at->diffForHumans()}}</td>

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
