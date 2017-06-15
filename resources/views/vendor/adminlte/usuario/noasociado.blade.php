@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">

			<div class="callout callout-info">
			 <h4>Opción solo para asociados!</h4>
			 Si desea parte de nuestro fondo llene el formulario y un funcionario se comunicará con usted

		 </div>

		 <div class="box box-primary">
		             <div class="box-header with-border">
		               <h3 class="box-title">Formulario de solicitud de asociado</h3>
		             </div>
		             <!-- /.box-header -->
		             <!-- form start -->
		             <form role="form">
		               <div class="box-body">
		                 <div class="form-group">
		                   <label for="exampleInputEmail1">Nombre Completo</label>
		                   <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
		                 </div>
		                 <div class="form-group">
		                   <label for="exampleInputPassword1">Correo</label>
		                   <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Password">
		                 </div>

		                 <div class="checkbox">
		                   <label>
		                     <input type="checkbox">Términos y condiciones
		                   </label>
		                 </div>
		               </div>
		               <!-- /.box-body -->
		               <div class="box-footer">
		                 <button type="submit" class="btn btn-primary">Enviar solicitud</button>
		               </div>
		             </form>
		           </div>




			</div>
	</div>


@endsection
