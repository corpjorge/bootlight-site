@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<section class="content-header">
    <h1>PQRS
    <small>Solicite su PQRS</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</li>
		<li><a href="#">PQRS</a></li>
    </ol>
</section>
<br>

	<div class="container-fluid spark-screen">
		<div class="row">
      <div class="col-md-6">
      <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Radicar PQRS</h3>
                  </div>
                  <!-- /.box-header -->
                  <!-- form start -->
                  <form role="form" action="{{ url('pqrs/add') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
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

                    <div class="box-body">
											<div class="form-group">
			 								<label>Tipo</label>
			 									<select style="color:#555555" name="tipo" class="form-control">
													<option style="color:#555555" value=""></option>
													<option style="color:#555555" value="Peticion">Petición</option>
													<option style="color:#555555" value="Queja">Queja</option>
													<option style="color:#555555" value="Reclamo">Reclamo</option>
													<option style="color:#555555" value="Sugerencia">Sugerencia</option>
												</select>
			 							</div>
                      <div class="form-group">
                        <label>Descripción</label>
                        <textarea style="color: black;"  class="form-control" rows="3" name="descripcion" placeholder="Descripción del PQRS"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputFile">Documento PDF </label>
                        <input name="file" type="file" id="file" accept=".pdf">
                        <p class="help-block">Formato PDF.</p>
                      </div>
                      <div class="checkbox">
                        <label>
                          <a data-toggle="modal" data-target="#myModal">Ver términos y condiciones </a>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label>
                          <input name="terminos" type="checkbox"> Acepto términos y condiciones
                        </label>
                      </div>
                    </div>

                   <div id="myModal" class="modal fade" role="dialog">
                     <div class="modal-dialog">

                       <!-- Modal content-->
                       <div class="modal-content">
                         <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                           <h4 class="modal-title">Tenga presente que:</h4>
                         </div>
                         <div class="modal-body">
                           <p>De acuerdo con la Ley Estatutaria 1581 de 2.012 de Protección de Datos y con el Decreto 1377 de 2.013, se informa al usuario que los datos consignados en el presente formulario serán incorporados en una base de datos responsabilidad de FONDO DE EMPLEADOS DE SODIMAC COLOMBIA FONSODI, siendo tratados con la finalidad de mantener contacto con los asociados o potenciales Asociados, a fin de ofrecer y gestionar los servicios ofrecidos directamente por FONSODI o a través de los convenios comerciales que buscar brindar tarifas beneficiosas para el Asociado y su grupo familiar. Usted puede ejercitar los derechos de acceso, corrección, supresión, revocación o reclamo por infracción sobre los datos, mediante escrito dirigido al FONDO DE EMPLEADOS DE SODIMAC COLOMBIA FONSODI o a la dirección de correo electrónico protecciondedatos@fonsodi.com indicando en el asunto el derecho que desea ejercitar, o mediante correo ordinario remitido a Cra. 28 Bis No. 49a - 07. El usuario declara haber leído la cláusula anterior y estar conforme con la misma.
													 </p>
                         </div>
                         <div class="modal-footer">
                           <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                         </div>
                       </div>
                     </div>
                   </div>
                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                  </form>
                </div></div>

<div class="col-md-6">

  <div class="box">
             <div class="box-header">
               <h3 class="box-title">Mis PQRS</h3>
             </div>
             <!-- /.box-header -->
             <div class="box-body no-padding">
               <table class="table table-condensed">
                 <tr>
                   <th>Titulo</th>
                   <th>Observación</th>
                   <th style="width: 40px">Estado</th>
                 </tr>
                 @foreach ($pqrs as $pqr)
                 <tr>
                   <td>{{$pqr->tipo}}</td>
                   <td>{{$pqr->observacion}}</td>
									 @if($pqr->pqrs_estado->id == 1)
                   <td><span class="badge label-{{$pqr->pqrs_estado->estilo}}">Respondido</span></td>
									 @else
									 <td><span class="badge label-{{$pqr->pqrs_estado->estilo}}">{{$pqr->pqrs_estado->tipo}}</span></td>
									 @endif
								 </tr>
                @endforeach
               </table>
             </div>
             <!-- /.box-body -->
           </div>
		</div>
	</div>
@endsection
