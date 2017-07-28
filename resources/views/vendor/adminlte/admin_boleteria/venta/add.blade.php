@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">

		@include('adminlte::admin_boleteria.venta.atras')

<script language="javascript" type="text/javascript">
function sumar(){
    obj = document.miform['seria'];
    totalChecks = obj.length;
    totalSumado = 0;
    for( i=0; i<totalChecks; i++){
        if( obj[i].checked == true ){
            valor = obj[i].value.split('-');
            totalSumado = totalSumado + parseInt(valor[0],10);
        }
    }
    document.getElementById('informacion').innerHTML = 'Total: '+ totalSumado.toLocaleString();
}
</script>
<script>
function marcar(obj,chk) {
	elem=obj.getElementsByTagName('input');
  for(i=0;i<elem.length;i++)
  	elem[i].checked=chk.checked;
}
</script>


            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ url('admin_boleteria/vender/add') }}" method="post" name="miform" id="miform">
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
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="usuario" value="{{ $usuario->usuario->id }}">
							<input type="hidden" name="cedula" value="{{$usuario->cedula}}">




			<div class="box box-primary">

					 <!-- /.box-header -->
					 <div class="box-header with-border">
						 <div class="col-md-6">
						 <h3>Nombre: {{$usuario->usuario->name}}</h3>
						 <h3>Cedula: {{$usuario->cedula}}</h3><br>
						 <h3 class="box-title">Seleccionar boletas a vender</h3>
					   </div>
						 <div class="col-md-6">
							 <div class="small-box bg-aqua">
	            <div class="inner">
	              <h3 id="informacion" style="font-size: 71PX;" >Total: 0</h3>
	            </div>
	            </div>
						 </div>
					 </div>
					 <div class="box-body">

						 <div class="form-group">
							 <label for="nombre">Numero de cuotas</label>
							 <input style="color:#555555; width: 165px;" type="number" class="form-control" id="cuotas" name="cuotas" placeholder="cuotas" min="1" max="6">
						 </div>

						@foreach ($productos as $producto)
							<div class="panel panel-default">
							  <div class="panel-heading">
							    <h3 class="panel-title">{{$producto->nombre}}</h3>
							  </div>
								@foreach ($seriales as $serial)
									@if($serial->serial_producto->nombre == $producto->nombre )
									 <label style="padding: 3px;" for="{{$serial->numero}}">
											 <ul class="todo-list">
												 <li>
													 <div style="display:inline;" >
													 <input  name="seria"  id="{{$serial->numero}}" type="checkbox"  value="{{$serial->precio_venta}}" onclick="sumar(), marcar(this.parentNode,this)" style="display: none;" >
													 <input  name="serial[]"  type="checkbox"  value="{{$serial->id}}" onclick="marcar(this.parentNode,this)" >
													 </div>
													 Serial: <span class="text ">{{$serial->numero}}</span>
													  . Precios UND: <span class="text">${{$serial->precio_venta}}</span>
												 </li>
											 </ul>
									   </label>
								  @endif
								 @endforeach
							</div>
						 @endforeach

					 <div class="box-footer">
						 <button type="submit" class="btn btn-primary">Vender</button>
					 </div>
				 </form>
			 </div>
			 </div>





		</div>
	</div>
@endsection
