@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">

			<div class="col-lg-offset-2 col-lg-8">
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-file-text-o"></i>

              <h3 class="box-title">TÉRMINOS Y CONDICIONES</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <p class="lead" style="text-align: justify"><a class="lead text-red">Fonsodi</a> y <a class="lead text-aqua">Delima Marsh</a> le informan que para el trámite del producto solicitado
								es necesario que se incluya la información requerida, así mismo indica que dicha información
								será utilizada exclusivamente para el proceso de cotización y venta del producto solicitado,
								y que en ningún caso Fonsodi, ni Delima Marsh utilizara esta información para promocionar
								producto diferente o para cualquier tipo de campaña promocional adicional, tampoco será compartida
								con ningún tercero y se guardaran los términos de confidencialidad de esta información para uso
								específico de esta solicitud.</p>

								<p class="lead" style="text-align: justify"><b>Importante: Si acepta términos y condiciones abra solicitado el producto y podrá anexar los documentos solicitados<b></p>


            </div>
            <!-- /.box-body -->
          </div>
				<a href="{{url('seguros/solicitar')}}" class="btn btn-block btn-warning">Cancelar</a>
					<button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#exampleModal">Aceptar Terminos y condicionesl</button>

          <!-- /.box -->
        </div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
			<form action="" method="" >
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adquirir producto {{$seguro_producto->name}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Por favor confirme la compra del producto {{$seguro_producto->name}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <a href="{{url('seguros/solicitar/add/'.$seguro_producto->id)}}" class="btn btn-primary">Adquirir producto</a>
      </div>
			</form>
    </div>
  </div>
</div>




			</div>
	</div>


@endsection
