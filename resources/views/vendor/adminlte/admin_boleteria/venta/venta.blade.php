@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<section class="content-header">
    <h1>Vender
    <small>Realiza las ventas ingresando el número de cedula del asociado</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</li>
		<li><a href="{{ url('/admin_boleteria')}}">Boletería</a></li>
        <li class="active"><a href="#">Vender</a></li>
    </ol>
</section>
<br>
	<div class="container-fluid spark-screen">
		<div class="row">

			{{-- <form role="form" action="{{ url('/admin_boleteria/vender/add/') }}" method="get">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="row">
			        <div class="col-md-3 col-sm-6 col-xs-12">
			          <div class="info-box">
			          <button type="submit" class="info-box-icon bg-aqua" style="border: none;" ><i class="fa fa-cart-plus"></i></button>
			            <div class="info-box-content">
			              <span class="info-box-number">
										<input style="color:#555555" type="number" class="form-control" id="cedula" name="cedula" placeholder="Cedula" required="required" ></span>
			            </div>
			          </div>
								@if(session()->has('error'))
		 				 		 <div class="alert alert-danger alert-dismissible">
		 				 				 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		 				 				 {{session()->get('error')}}
		 				 		 </div>
		 				 		@endif
			        </div>
						 </div>
			</form> --}}

			<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="{{ url('admin_boleteria/vender/add')}}" class="info-box-icon bg-aqua" style="border: none;" ><i class="fa fa-cart-plus"></i></a>

        </div>
			 </div>
			</form>
			<br>

			@if(session()->has('message'))
			 <div class="alert alert-success alert-dismissible">
								 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								 <h4><i class="icon fa fa-check"></i> Correcto!</h4>
								 {{session()->get('message')}}
							 </div>
			@endif


		<div class="box">
             <div class="box-header">
               <h3 class="box-title">Ventas del día</h3>
             </div>
             <!-- /.box-header -->
             <div class="box-body">
               <table  class="table table-bordered ">
                 <thead>
                 <tr>
									 <th>Nombre</th>
                   <th>Cuotas</th>
									 <th>Referencia</th>
									 <th>Fecha</th>
                 </tr>
                 </thead>
                 <tbody>
								 @foreach ($ventas as $venta)
                 <tr>
									 	 <td><a href="{{url('datos_usuario/'.$venta->admin_user_id)}}">{{$venta->venta_user->name}}</a></td>
										 <td>{{$venta->cuota}}</td>
										 <td><a href="{{url('admin_boleteria/vender/ver/'.$venta->id)}}"> {{$venta->referencia}}</a></td>
										 <td>{{$venta->created_at->diffForHumans()}}</td>
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
