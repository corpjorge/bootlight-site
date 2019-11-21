@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">

		<div class="row">
			<a href="{{url('admin_evento/add')}}" >
         <div class="col-md-1">
             <span class="info-box-icon bg-aqua"><i class="fa fa-plus"></i></span>
         </div>
			</a>
    </div><br>

		@if(session()->has('message'))
		 <div class="alert alert-success alert-dismissible">
							 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							 <h4><i class="icon fa fa-check"></i> Correcto!</h4>
							 {{session()->get('message')}}
						 </div>
		@endif

		<div class="box">
             <div class="box-header">
               <h3 class="box-title">Eventos</h3>
             </div>
             <!-- /.box-header -->
             <div class="box-body">
               <table id="example" class="table table-bordered table-striped">
                 <thead>
                 <tr>
									 <th>nombre</th>
									 <th>Editar</th>
									 <th>Estado</th>
									 <th>Fecha</th>
                 </tr>
                 </thead>
                 <tbody>
								 @foreach ($eventos as $evento)
                 <tr>
										 <td>{{$evento->name}}</td>
										 <td><a href="{{url('admin_evento/ver/'.$evento->id.'/edit')}}" >
											  <i class="fa fa-fw fa-edit"></i>Editar</a>
										 </td>
										 <td>
											 <a class="label label-{{$evento->evento_estado->estilo}}" style="cursor: pointer;" data-toggle="modal" data-target="#eliminar{{$evento->id}}">
												 @if($evento->evento_estado->id == 1)
 												<i class="fa fa-fw fa-power-off"></i>Desactivar</a>
												@else
												<i class="fa fa-fw fa-power-off"></i> Activar</a>
												@endif
												<div id="eliminar{{$evento->id}}" class="modal fade" role="dialog">
	 										  <div class="modal-dialog">
	 										    <div class="modal-content">
	 													<form action="{{url('admin_evento/estado/'.$evento->id)}}" method="post" >
	 	 												 <input type="hidden" name="_token" value="{{ csrf_token() }}">
	 										      <div class="modal-header">
	 										        <button type="button" class="close" data-dismiss="modal">&times;</button>
	 										        <h4 class="modal-title">Confirmar</h4>
	 										      </div>
	 										      <div class="modal-body">
															@if($evento->evento_estado->id == 1)
		  												 <p>Desactivar evento <b>{{$evento->name}}</b></p>
		 												@else
		 												 <p>Activar evento <b>{{$evento->name}}</b></p>
		 												@endif
	 										      </div>
	 										      <div class="modal-footer">
	 														<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	 										        <button type="submit" class="btn btn-primary" >aceptar</button>
	 										      </div>
	 													</form>
	 										    </div>
	 										  </div>
	 										</div>

										</td>
										 <td>{{$evento->created_at->diffForHumans()}}</td>

								 </tr>
								 @endforeach



                 </tfoot>
               </table>
             </div>
             <!-- /.box-body -->
           </div>

 <!--
					 <ul class="pagination">
					   <li class="paginate_button "><a href="#">1</a></li>
					   <li class="paginate_button "><a href="#">2</a></li>
					   <li class="paginate_button "><a href="#">3</a></li>
					   <li><a href="#">4</a></li>
					   <li><a href="#">5</a></li>
					 </ul>
-->





		</div>
	</div>
@endsection
