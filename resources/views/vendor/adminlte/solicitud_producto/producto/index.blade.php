@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<section class="content-header">
    <h1>Productos
    <small>Ingreso de Productos</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</li>
		<li><a href="{{ url('/admin_boleteria')}}">Productos</a></li>
        <li class="active"><a href="#">Productos</a></li>
    </ol>
</section>
<br>
	<div class="container-fluid spark-screen">
		<div class="row">



		<div class="row">
			<a href="{{url('solicitudes/productos/add')}}" >
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
									 <th>Fecha</th>
                 </tr>
                 </thead>
                 <tbody>
								 @foreach ($productos as $producto)
                 <tr>
	                   <td>{{$producto->codigo}}</td>
										 <td>{{$producto->name}}</td>
										 <td>
											@if($producto->linea == 1)
												Servicio
											@else
												Consumo proveedores
											@endif

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
