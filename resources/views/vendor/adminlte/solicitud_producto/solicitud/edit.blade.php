@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')

<section class="content-header">
    <h1>Aprobar Producto
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</li>
		<li><a href="#">Aprobar</a></li>
    </ol>
</section>
<br>
<div class="col-md-3 col-sm-6 col-xs-12"><a href="{{ url('solicitudes/solicitados/3')}}" style="border: none;" class="info-box-icon bg-yellow"><i class="fa fa-chevron-left"></i></a></div><br><br><br><br><br>

	<div class="container-fluid spark-screen">

		<div class="row">
      <div class="col-md-12">
      <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Aprobar Producto</h3>
                  </div>
                  <!-- /.box-header -->
                  <!-- form start -->
                  <form role="form" action="{{ url('solicitudes/solicitados/ver/'.$row->id) }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="cedula" value="{{ $row->cedula }}">
                    <input type="hidden" name="codigo" value="{{ $row->codigo }}">
                    @if (count($errors) > 0)
      			            <div class="alert alert-danger">
      			                <strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
      			                <ul>
      			                    @foreach ($errors->all() as $error)
      			                        <li>{{ $error }}</li>
      			                    @endforeach
      			                </ul>
      			            </div>
      			        @endif
                    @if(session()->has('message'))
                		 <div class="alert alert-success alert-dismissible">
                							 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                							 <h4><i class="icon fa fa-check"></i> Correcto!</h4>
                							 {{session()->get('message')}}
                						 </div>
                		@endif

                    <div class="box-body">                      
                      <div class="form-group">
                        <label>Productos</label>
                        <select class="form-control" disabled="">
                          <option>{{$row->producto->name}}</option>                                       
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Valor del Monto</label>
                        <input style="color: black;" type="number" class="form-control" id="monto" name="monto" placeholder="$ 10000" min="1" max="1000000" value="{{$row->monto}}" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Meses</label>
                        <input style="color: black;" type="number" class="form-control" id="cuota" name="cuota" placeholder="6" min="1" max="12" value="{{$row->cuotas}}" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Observaciones</label>
                        <input style="color: black;" type="text" class="form-control" id="observaciones" name="observaciones" value="" required>
                      </div>
              
                   
                    </div>                

                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary" name="Aprobar" value="Aprobar">Aprobar</button>
                      <button type="submit" class="btn btn-danger" name="Negar" value="Negar">Negar</button>
                    </div>
                  </form>
                </div></div>

 
	</div>
@endsection
