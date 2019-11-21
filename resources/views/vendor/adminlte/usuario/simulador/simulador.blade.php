<!DOCTYPE html>
<html>
<head>
	<title>Simulador</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/jquery.chained.min.js') }}"></script>
</head>
<body>
	<div class="container">
			<div class="mt-3">

			</div>
			<p class="lead">Realice un cálculo aproximado de cualquiera de nuestras líneas,
				 si desea comunicarse con uno de nuestros asesores de
				 <a href="http://fonsodi.com/contactenos" target="_blank"> clic aquí . </a></p>

				 <div class="form-group">
		       <div class="text-right">
		         <a href="http://fonsodi.com/lineas-creditos" class="btn btn-danger" target="_blank">Ver las líneas</a>
		       </div>
		     </div>

   <form class="form" method="post" action="{{url('simulador/add')}}" id="form1" >
     	<input type="hidden" name="_token" value="{{ csrf_token() }}">
   <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Línea de crédito <span class="required">*</span></label>
     <div class="col-md-9 col-sm-9 col-xs-12">
       <select onchange="mostrar(this,1);" id="linea" name="linea" class="date-picker form-control col-md-7 col-xs-12" tabindex="-1" required>
  		     <option  value=''></option>
           @foreach ($lineas as $linea)
           <option value='{{$linea->id}}'>{{$linea->name}}</option>
           @endforeach
       </select>
     </div>
   </div>

   <div class='form-group'>
      <label class='control-label col-md-3 col-sm-3 col-xs-12'>Plazo en meses</label>
      <div class='col-md-9 col-sm-9 col-xs-12'>
        <select id="meses" name='meses' class='select2_single form-control' tabindex='-1'>
        <option value=''></option>
        @foreach ($tasas as $tasa)
          @for ($x = $tasa->plazo_inicial; $x <= $tasa->plazo_final; $x++)
						@if($tasa->plazo_inicial == 0)
							<option class='{{$tasa->simuladortasa_linea->id}}' value='{{$x}}'>Pago único</option>
						@else
              <option class='{{$tasa->simuladortasa_linea->id}}' value='{{$x}}'>{{$x}}</option>
						@endif
					@endfor
        @endforeach
        </select>
      </div>
    </div>

    <div id="describe1"></div>

    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Valor solicitado<span class="required">*</span> <P><small>Digitar valores sin puntos comas ni espacios </small></P>
      </label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <input name="monto1" class="date-picker form-control col-md-7 col-xs-12" required type="number" title="Solo números, sin comas, ni puntos, ni símbolos" pattern="[0-9]"
          oninvalid="setCustomValidity('Solo números, sin comas, ni puntos, ni símbolos')"
          oninput="setCustomValidity('')"
          >
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
        <button type="submit" class="btn btn-danger">Calcular</button>
      </div>
    </div>
  </form>
</div>
</body>
</html>

<script> $("#meses").chained("#linea"); /* or $("#series").chainedTo("#mark"); */</script>
<?php
$text1 ='<div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12"></label><div class="col-md-9 col-sm-9 col-xs-12"><div class="alert alert-success">&nbsp; &nbsp; <b>';
$textB = '</b></div></div>';
echo
"<script type='text/javascript'>
  function mostrar( obj , x){

    var container = document.getElementById('describe' + x) ;
      if( obj[ obj.selectedIndex ].value == '' ){
        container.innerHTML = '<h1>dsfa</h1>' ;
      }
"; foreach ($lineas as $linea) { echo"

      if( obj[ obj.selectedIndex ].value == ".$linea->id." ){
        container.innerHTML = '".$text1.$linea->observacion.$textB."' ;
        var seleccion = 1;
        }

";} echo "
  }
</script>";
?>
