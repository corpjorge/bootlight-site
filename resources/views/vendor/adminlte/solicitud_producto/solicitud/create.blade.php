@extends('adminlte::layouts.app')



@section('htmlheader_title')

	{{ trans('adminlte_lang::message.home') }}

@endsection



@section('main-content')



<section class="content-header">

    <h1>Solicitar Producto

    <small></small>

    </h1>

    <ol class="breadcrumb">

        <li><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</li>

		<li><a href="#">Solicitud</a></li>

    </ol>

</section>

<br>



	<div class="container-fluid spark-screen">

		<div class="row">

      <div class="col-md-12">

      <div class="box box-primary">

                  <div class="box-header with-border">

                    <h3 class="box-title">Estimado Asociado(a) antes de realizar su solicitud, consulte información importante en el siguiente link:<a href="http://www.fonsodi.com/images/convenios/bogota/Productos.jpg">fonsodi</a> </h3>

                  </div>

                  <!-- /.box-header -->

                  <!-- form start -->

                  <form role="form" action="{{ route('solicitud.store') }}" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <input type="hidden" name="cedula" value="{{ $usuario->cedula }}">

                    <input type="hidden" name="cod_asociado" value="{{ $usuario->cod_persona }}">                    

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

                        <label>Productos</label>

                        <select class="form-control" name="producto" id="producto_solicitud" required>

                          <option value="">Seleccionar</option>  

                          @foreach( $rows as $key)

                            <option value="{{$key->id}}">{{$key->name}}</option>             

                          @endforeach             

                        </select>

                      </div>

                      <div class="form-group">

                        <label for="exampleInputEmail1">Valor del Monto</label>

                        <input style="color: black;" type="number" class="form-control" id="monto" name="monto" placeholder="$ 10000" min="1" max="1000000" required>

                      </div>                      

                      <div class="form-group">

                        <label for="exampleInputEmail1">Meses</label>

                        <input style="color: black;" type="number" class="form-control" id="cuota" name="cuota" placeholder="6" min="1" max="6" required>

                      </div>
                      
                      <div id="cajon" class="none">
                          
                           <div class="form-group">
    
                                <label>Bancos</label>
        
                                <select class="form-control" name="bank_id" id="bank_id">
        
                                  <option value="">Seleccionar</option>  
        
                                  @foreach( $banks as $key)
        
                                    <option value="{{$key->id}}">{{$key->name}}</option>             
        
                                  @endforeach             
        
                                </select>
    
                          </div>
                          
                          <div class="form-group">
        
                                <label>Tipo de cuenta</label>
        
                                <select class="form-control" name="account_type" id="account_type">
        
                                    <option value="">Seleccionar</option>  
        
                                    <option value="0">Ahorros</option>             
        
                                    <option value="1">Corriente</option>  
                                    
                                </select>
    
                          </div>
                          
                          <div class="form-group">
    
                            <label>Número de cuenta</label>
    
                            <input name="account" class="form-control"   type="text" id="account_number">
    
                          </div>
                      
                      </div>
                      
                                  
                      <div class="form-group">

                        <label>Número de Celular</label>

                        <input name="celular" class="form-control" pattern="[0-9]{10}" required="" type="tel" title="10 Dígitos" oninvalid="setCustomValidity('Ingrese un número de celular correcto')" oninput="setCustomValidity('')">

                      </div>

                      <div class="form-group">

                        <label>Por favor ingrese las características especificas del producto a solicitar.</label>

                        <input style="color: black;" class="form-control" name="observaciones">

                      </div>

                      <div id="idurl" class="form-group" style="display: none;">                       

                        Estimado asociado si desea conocer las características del producto a solicitar ingrese a: <a id="urllink" target="_blank">Clic Aquí</a>

                      </div>

                      <div class="form-group">

                        <label for="exampleInputFile">Adjuntar desprendible de pago </label>

                        <input name="file" type="file" id="file" accept="image/*,application/pdf" required>

                        <p class="help-block">Imagen o PDF.</p>

                      </div>

                      <div class="checkbox">

                        <label>

                          <a href="{{ asset('CONDICIONES Y RESTRICCIONES OFICINA VIRTUAL.pdf')}}" target="_blank">Ver términos y condiciones </a>

                        <!--  <a data-toggle="modal" data-target="#myModal">Ver términos y condiciones </a>-->

                        </label>

                      </div>

                      <div class="checkbox">

                        <label>

                          <input name="terminos" type="checkbox" required> Acepto términos y condiciones

                        </label>

                      </div>

                    </div>

<!--

                   <div id="myModal" class="modal fade" role="dialog">

                     <div class="modal-dialog">



                 

                       <div class="modal-content">

                         <div class="modal-header">

                           <button type="button" class="close" data-dismiss="modal">&times;</button>

                           <h4 class="modal-title">Tenga presente que:</h4>

                         </div>



                         <div class="modal-body">

                           <p>* FONSODI se reserva los derechos para borrar o eliminar sin previo aviso la información que se incluya.

														 <br>

														* FONSODI no se hace responsable de la calidad y/o estado del servicio de los productos que se ofrezcan a través de esta plataforma.

														<br>

														* La información subida al portal de clasificados, son aquellos que solicitan la publicación quienes se hacen responsables del cumplimiento y protección de las leyes de derechos de autor colombianas, cualquier violación de las normas nacionales o internacionales será asumida por el asociado el cual solicito la publicación.

														<br>

														* Está prohibido solicitar pagos periódicos o anticipados, ofrecer membresías a esquemas de negocio piramidal.

														<br>

														* Está prohibido entregar información falsa de cualquier producto o servicio.

														<br>

														* FONSODI no es intermediario en ningún tipo de negociación, la responsabilidad de adquirir u ofrecer algún bien o servicio está bajo la responsabilidad de aquel quien solicita la publicación.

														<br>

														* Los anuncios publicados en el portal son sometidos a procesos de verificación, de no cumplir con los requisitos serán eliminados del sitio sin previo aviso.

														<br>

														* Si desea que su publicación sea retirada comuníquese a la dirección de correo comunicaciones@fonsodi.com desde el correo donde hizo la solicitud de su clasificado.

														<br>

														* La publicación estará activa por un lapso de 30 días, trascurrido ese tiempo se procederá a retirar el clasificado.

														<br>

														* Aplica para asociados que se encuentren al día con sus obligaciones con FONSODI.

														<br>

														De acuerdo con la Ley Estatutaria 1581 de 2.012 de Protección de Datos y con el Decreto 1377 de 2.013, se informa al usuario que los datos consignados en el presente formulario serán incorporados en una base de datos responsabilidad de FONDO DE EMPLEADOS DE SODIMAC COLOMBIA FONSODI, siendo tratados con la finalidad de mantener contacto con los asociados o potenciales Asociados, a fin de ofrecer y gestionar los servicios ofrecidos directamente por FONSODI o a través de los convenios comerciales que buscar brindar tarifas beneficiosas para el Asociado y su grupo familiar. Usted puede ejercitar los derechos de acceso, corrección, supresión, revocación o reclamo por infracción sobre los datos, mediante escrito dirigido a FONDO DE EMPLEADOS DE SODIMAC COLOMBIA FONSODI a la dirección de correo electrónico protecciondedatos@fonsodi.com indicando en el asunto el derecho que desea ejercitar, o mediante correo ordinario remitido a Cra. 28 Bis No. 49a - 07. El usuario declara haber leído la cláusula anterior y estar conforme con la misma.

														</p>

                         </div> 

                         <div class="modal-footer">

                           <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                         </div>

                       </div>

                     </div>

                   </div>-->



                    <div class="box-footer">

                      <button type="submit" class="btn btn-primary">Guardar</button>

                    </div>

                  </form>

                </div></div>


	</div>

@endsection

