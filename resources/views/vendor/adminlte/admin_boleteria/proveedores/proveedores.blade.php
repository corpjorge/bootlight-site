@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<section class="content-header">
    <h1>Proveedores
    <small>Ingreso de proveedores</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</li>
		<li><a href="{{ url('/admin_boleteria')}}">Boletería</a></li>
        <li class="active"><a href="#">Proveedores</a></li>
    </ol>
</section>
<br>
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
									 <th>linea</th>
                   <th>Editar</th>
									 <th>Fecha</th>
                 </tr>
                 </thead>
                 <tbody>
								 @foreach ($proveedores as $proveedor)
                 <tr>
	                   <td>{{$proveedor->codigo}}</td>
										 <td><a href="{{url('admin_boleteria/proveedores/ver/'.$proveedor->id)}}" >{{$proveedor->name}}</a></td>
										 <td>
											@if($proveedor->linea == 1)
												Servicio
											@else
												Consumo proveedores
											@endif


										 </td>
										 <td><a href="{{url('admin_boleteria/proveedores/ver/'.$proveedor->id.'/edit')}}" >
											  <i class="fa fa-fw fa-edit"></i>Editar</a>
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
