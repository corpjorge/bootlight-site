@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')

<section class="content-header">
    <h1>Agregar Producto
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</li>
		<li><a href="#">Agregar</a></li>
    </ol>
</section>
<br>

	<div class="container-fluid spark-screen">
		<div class="row">
      <div class="col-md-12">
      <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Agregar Producto</h3>
                  </div>
                  <!-- /.box-header -->
                  <!-- form start -->
                  <form role="form" action="{{route('productos.store') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          
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
                							 <h4><i class="icon fa fa-check"></i> correcto!</h4>
                							 {{session()->get('message')}}
                						 </div>
                		@endif

                    <div class="box-body"> 
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Tipo</label>
                                <select class="form-control" name="tipo" required>
                                  <option value="">Seleccionar</option> 
                                  <option value="1">Credito</option> 
                                  <option value="2">Servicio</option> 
                                </select>
                            </div>
                        </div>
                         <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre</label>
                                <input style="color: black;" type="text" class="form-control" name="name">
                             </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Código</label>
                                <input style="color: black;" type="number" class="form-control" name="codigo">
                            </div>
                        </div>
                         <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Linea</label>
                                <input style="color: black;" type="number" class="form-control" name="linea">
                             </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nit</label>
                                <input style="color: black;" type="number" class="form-control" name="nit"  min="1"  required>
                              </div>
                        </div>
                         <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Meses Minimo</label>
                                <input style="color: black;" type="number" class="form-control" name="cuota_min"  min="1"  required>
                              </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Meses maximo</label>
                                <input style="color: black;" type="number" class="form-control" name="cuota_max"  min="1"  required>
                              </div>
                        </div>
                         <div class="col-md-6 col-sm-12">
                             <div class="form-group">
                                <label for="exampleInputEmail1">Monto Minimo</label>
                                <input style="color: black;" type="number" class="form-control" name="monto_min"  min="1"  required>
                             </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                             <div class="form-group">
                                <label for="exampleInputEmail1">Monto Maximo</label>
                                <input style="color: black;" type="number" class="form-control" name="monto_max"  min="1"  required>
                             </div>
                        </div>
                         <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                        <label for="exampleInputEmail1">URL</label>
                        <input style="color: black;" type="text" class="form-control" name="url">
                      </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Correo</label>
                                <input style="color: black;" type="email" class="form-control" name="correo">
                              </div>
                        </div>
                    </div>


                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                  </form>
                </div></div>

 
	</div>
@endsection
