@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">

			<div class="row">
				<a href="{{url('seguros/solicitar')}}">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-shield"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Solicitar seguro</span>
              <span >Clic aquí</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
			</a>
        <!-- /.col -->


				@if(session()->has('message'))
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-flag-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Alerta</span>
              <span class="info-box-number">{{session()->get('message')}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>@endif
        <!-- /.col 
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-files-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Documentos</span>
              <span class="info-box-number">{{$cantarchitotal}}</span>
							 <a href=""> <span class="">Ver</span></a>
            </div>

          </div>

        </div>
        <!-- /.col -->

        <!-- /.col -->
      </div>

			@if(session()->has('message'))
			 <div class="alert alert-warning alert-dismissible">
								 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								 <h4><i class="icon fa fa-check"></i>¡{{session()->get('message')}}!</h4>
							 </div>
			@endif

			<div class="row">
		         <div class="col-xs-12">
		           <div class="box">
		             <div class="box-header">
		               <h3 class="box-title">Seguros solicitados</h3>

		               <div class="box-tools">
		                 <div class="input-group input-group-sm" style="width: 150px;">

		                 </div>
		               </div>
		             </div>
		             <!-- /.box-header -->
		             <div class="box-body table-responsive no-padding">
		               <table class="table table-hover">
		                 <tr>
		                   <th>Seguro</th>
		                   <th>Solicitado</th>
		                   <th>Estado</th>
		                   <th>Observación</th>
											 <th>Editar</th>
		                 </tr>
										 @foreach($seguros as $seguro)
										 <tr>
											 <td><a href="{{url('seguros/ver/'.$seguro->id)}}" >{{$seguro->seguro_producto->name}}</a></td>
		                   <td>{{$seguro->created_at->format('d-m-Y')}}</td>
											 	<td><span class="label label-{{$seguro->seguro_estado_geneal->estilo}}">{{$seguro->seguro_estado_geneal->tipo}}</span></td>
		                   <td>{{$seguro->observacion_general}}</td>
											 <td><a href="{{url('seguros/ver/'.$seguro->id.'/edit')}}" >
												  <i class="fa fa-fw fa-upload"></i>Subir archivos</a>
											 </td>
		                 </tr>
										 @endforeach
		               </table>
		             </div>
		             <!-- /.box-body -->
		           </div>
		           <!-- /.box -->
		         </div>
		       </div>





    </div>
	</div>



@endsection
