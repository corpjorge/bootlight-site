@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
<section class="content-header">
    <h1>Productos
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</li>
				<li><a href="{{ url('/Productos')}}">Productos</a></li>
    </ol>
</section>
<br>
 


	<div class="col-md12">
	 <div class="callout callout-danger">
                <h4>SIN CORREO REGISTRADO</h4>

                <p>Lo sentimos usted no cuenta con un correo registrado en FONSODI, para más información de como actualizar su correo comuníquese a los medios dando clic en el siguente enlace <a href="http://fonsodi.com/contactenos">http://fonsodi.com/contactenos</a></p>
              </div>
	</div>



@endsection
