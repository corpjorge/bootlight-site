@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<section class="content-header">
    <h1>Seriales
    <small>Ingreso de seriales</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</li>
		<li><a href="{{ url('/admin_boleteria')}}">Boletería</a></li>
        <li class="active"><a href="#">Seriales</a></li>
    </ol>
</section>
<br>
	<div class="container-fluid spark-screen">
		<div class="row">


<form role="form" action="{{ url('/admin_boleteria/seriales/add/') }}" method="get">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
          <button type="submit" class="info-box-icon bg-aqua" style="border: none;" ><i class="fa fa-plus"></i></button>
            <div class="info-box-content">
              <span class="info-box-number">
							<input style="color:#555555" type="text" class="form-control" id="nombre" name="cantidad" placeholder="Cantidad" required="required" pattern="[0-9]{1,4}"></span>
							<div class="form-group">
                  <div class="checkbox">
                    <label>
                      <input name="consecutivo" value="1" type="checkbox">
                      Consecutivos
                    </label>
                  </div>
              </div>
            </div>
          </div>
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
               <h3 class="box-title">Seriales</h3>
             </div>
             <!-- /.box-header -->
             <div class="box-body">
               <table id="example" class="table table-bordered table-striped">
                 <thead>
                 <tr>
								 	 <th>Serial</th>
                   <th>Producto</th>
									 <th>Fecha de Caducidad</th>
									 <th>Editar</th>
									 <th>Creado</th>
                 </tr>
                 </thead>
                 <tbody>
								 @foreach ($seriales as $serial)
                 <tr>
	                   <td><a href="{{url('admin_boleteria/seriales/ver/'.$serial->id)}}" >{{$serial->numero}}</a></td>
										 <td><a href="{{url('admin_boleteria/productos/ver/'.$serial->producto_id)}}">{{$serial->serial_producto->nombre}}</a></td>
										 <td>{{$serial->fecha_caducidad}}</td>
										 <td><a href="{{url('admin_boleteria/seriales/ver/'.$serial->id.'/edit')}}" >
											  <i class="fa fa-fw fa-edit"></i>Editar</a>
										 </td>
										 <td>{{$serial->created_at->diffForHumans()}}</td>
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
