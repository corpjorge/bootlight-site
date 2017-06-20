@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
<section class="content-header">
    <h1>Transferencia solidaria
    <small>Revisa tu trasferencia solidaria</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</li>
				<li><a href="{{ url('/home')}}">Inicio</a></li>
        <li class="active"><a href="#">Transferencia solidaria</a></li>
    </ol>
</section>

<br>

<div class="row">
  <a href="{{url('home')}}" >
     <div class="col-md-1">
         <span class="info-box-icon bg-yellow"><i class="fa fa-chevron-left"></i></span>
     </div>
  </a>
	<a href="{{$url_doc}}" >
     <div class="col-md-1">
         <span class="info-box-icon bg-blue"><i class="fa fa-download"></i></span>
     </div>
  </a>
	<div class="col-md-8">
			<b style="color: blue" > Si no puede visualizar el archivo haga clic en el botón azul para descargar</b>
	</div>


</div>
<br>



<iframe src="{{$url_doc}}" width="100%" height="400px"></iframe>


@endsection
