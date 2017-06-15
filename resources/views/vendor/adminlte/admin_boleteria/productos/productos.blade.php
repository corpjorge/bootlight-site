@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">

			<div class="row">
				<a href="{{ url('/admin_boleteria/productos/add') }}" >
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
               <h3 class="box-title">Productos</h3>
             </div>
             <!-- /.box-header -->
             <div class="box-body">
               <table id="example" class="table table-bordered table-striped">
                 <thead>
                 <tr>
									 <th>ID</th>
                   <th>Nombre</th>
                   <th>Proveedor</th>
									 <th>Editar</th>
									 <th>Fecha</th>
                 </tr>
                 </thead>
                 <tbody>
								 @foreach ($productos as $producto)
                 <tr>
	                   <td>{{$producto->id}}</td>
										 <td><a href="{{url('admin_boleteria/productos/ver/'.$producto->id)}}" >{{$producto->nombre}}</a></td>
										 <td><a href="{{url('admin_boleteria/proveedores/ver/'.$producto->producto_provedor->id)}}" >
											 	 {{$producto->producto_provedor->name}}</td>
										 <td><a href="{{url('admin_boleteria/productos/ver/'.$producto->id.'/edit')}}" >
											  <i class="fa fa-fw fa-edit"></i>Editar</a>
										 </td>
										 <td>{{$producto->created_at->diffForHumans()}}</td>

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
