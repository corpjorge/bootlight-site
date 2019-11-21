@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection @section('main-content')

<section class="content-header">
	<h1>Coordinador
    <small>Asignaciones realizadas</small>
    </h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</li>
		<li><a href="{{ url('/admin_boleteria')}}">Boletería</a></li>
		<li class="active"><a href="#">Coordinador</a></li>
	</ol>
</section>
<br>

<div class="container-fluid spark-screen">
	<div class="row">

		@if(session()->has('message'))
		<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Correcto!</h4> {{session()->get('message')}}
		</div>
		@endif

		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Asignaciones</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<table id="example" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Usuario</th>
							<th>Ver</th>
						</tr>
					</thead>
					<tbody>
					@foreach ($useradmins as $useradmin)
						<tr>
							<td>{{$useradmin->id}}</td>
							<td>{{$useradmin->name}}</td>
							<td><a href="{{ url('admin_boleteria/coordinador/ver/'.$useradmin->id)}}"><i class="fa fa-search" aria-hidden="true"></i> Ver</a></td>

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
