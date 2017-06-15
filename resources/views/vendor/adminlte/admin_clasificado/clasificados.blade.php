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
               <h3 class="box-title">Clasificados</h3>
             </div>
             <!-- /.box-header -->
             <div class="box-body">
               <table id="example" class="table table-bordered table-striped">
                 <thead>
                 <tr>
									 <th>titulo</th>
                   <th>Estado</th>
                   <th>observacion</th>
                   <th>Editar</th>
									 <th>Fecha</th>
                 </tr>
                 </thead>
                 <tbody>
									 @foreach($clasificados as $clasificado)
	                 <tr>
											 <td><a href="{{url('admin_servicios/clasificados/ver/'.$clasificado->id)}}">{{$clasificado->titulo}}</a></td>
											 <td><span class="label label-{{$clasificado->clasificado_estado->estilo}}">{{$clasificado->clasificado_estado->tipo}}</span></td>
											 <td>{{$clasificado->observacion}}</td>
											 <td><a href="{{url('admin_servicios/clasificados/ver/'.$clasificado->id.'/edit')}}"><i class="fa fa-fw fa-edit"></i>Editar</a></td>
											 <td>{{$clasificado->created_at->diffForHumans()}}</td>
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
