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
</div><br>

<iframe src="http://fonsodi.com/images/oficina_virtual/2017/PDF1701175027.pdf" width="100%" height="400px"></iframe>


@endsection
