@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<section class="content-header">
    <h1>Item de las Áreas de administrador añadir
    <small>Configuracion de Areas de administrador</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</li>
		<li><a href="{{ url('/admin_config/areas_admin_item')}}">Configuracion</a></li>
				<li><a href="{{ url('/admin_config/areas_admin_item')}}">Item de Areas de administrador</a></li>
        <li class="active"><a href="#">Editar</a></li>
    </ol>
</section>
<br>
	<div class="container-fluid spark-screen">
		<div class="row">


			@include('adminlte::admin.areas_admin_item.atras')



		<div class="">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Editar de Item del Area</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ url('admin_config/areas_admin_items/'.$area_item_admins->id)}}" method="post">
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

							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							{{method_field('PUT')}}
              <div class="box-body">


							<div class="form-group">
								 <label>Area</label>
									 <select style="color:#555555" name="usuario" class="form-control">
										 	<option value="{{$area_item_admins->area->id}}">{{$area_item_admins->area->name}}</option>
										 @foreach ($area_admins as $area_admin)
								 		 	<option style="color:#555555" value="{{$area_admin->id}}">{{$area_admin->name}}</option>
								 		 @endforeach
									 </select>
							 </div>

							 


              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form>
          </div>

		</div>






		</div>
	</div>
@endsection
