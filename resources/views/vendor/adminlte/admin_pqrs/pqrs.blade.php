@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">


		@if(session()->has('message'))
		 <div class="alert alert-success alert-dismissible">
							 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							 <h4><i class="icon fa fa-check"></i> Correcto!</h4>
							 {{session()->get('message')}}
						 </div>
		@endif

		<div class="box">
             <div class="box-header">
               <h3 class="box-title">PQRS</h3>
             </div>
             <!-- /.box-header -->
             <div class="box-body">
               <table id="example" class="table table-bordered table-striped">
                 <thead>
                 <tr>
									 <th>titulo</th>
                   <th>Estado</th>
                   <th>observacion</th>
									 <th>Fecha</th>
                 </tr>
                 </thead>
                 <tbody>
									 @foreach($pqrs as $pqr)
	                 <tr>
											 <td><a href="{{url('admin_servicios/pqrs/ver/'.$pqr->id)}}">{{$pqr->tipo}}</a></td>
											 <td><span class="label label-{{$pqr->pqrs_estado->estilo}}">{{$pqr->pqrs_estado->tipo}}</span></td>
											 <td>{{$pqr->observacion}}</td>
											 <td>{{$pqr->created_at->diffForHumans()}}</td>
									 </tr>
									 @endforeach
                 </tbody>
               </table>
             </div>
             <!-- /.box-body -->
           </div>



		</div>
	</div>
@endsection
