<!DOCTYPE html>
<html>
<head>
	<title>Simulador</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
      <div class="mt-3">

      </div>
			<p class="lead">Resultado aproximado de la linea {{$nombretasa}},
				 si desea comunicarse con uno de nuestros asesores de
				 <a href="http://fonsodi.com/contactenos" target="_blank"> clic aquí . </a></p>

    <div class="form-group">
      <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
        <a href="{{url('simulador')}}" class="btn btn-danger">Atras</a>
			<form class="form" method="post" action="{{url('simulador/pdf')}}" style="width: 0px;height: 0px;left: 94px;top: 0px;position: absolute;" >
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="linea" value="{{$idline}}">
				<input type="hidden" name="meses" value="{{$meses}}">
				<input type="hidden" name="monto1" value="{{$monto}}">
				<button type="submit" class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-sm" onclick="updateReloj()">Generar PDF</button>
			</form>
      </div>
    </div>


		<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-sm">
		    <div class="modal-content">
	 			<h2 id='CuentaAtras'></h2>
		    </div>
		  </div>
		</div>

@if($meses == 0)
<?php
	$interes = $cuota*$mes;
	$final = $cuota;
	$mesa = $mesa+1;
	$amort = 0;
	$total=$cuota+$interes;
?>
<table class="table">
	<thead>
		<tr>
			<th>VALOR SIMULADO</th>
			<th>VALOR TOTAL A PAGAR</th>
			<th>INTERES</th>
			<th>LÍNEA DE CRÉDITO</th>
			<th>TASA DE INTERÉS</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?php echo number_format($monto);  ?> </td>
			<td><?php echo number_format($total);  ?> </td>
			<td><?php echo number_format($interes);?> </td>
			<td><?php echo $nombretasa;  ?> </td>
			<td><?php echo $valortasa;  ?>% </td>
		</tr>
	</tbody>
</table>
@else
<table class="table">
	<thead>
		<tr>
			<th>VALOR SIMULADO</th>
			<th>VALOR TOTAL A PAGAR</th>
			<th>VALOR TOTAL INTERÉS</th>
			<th>LÍNEA DE CRÉDITO</th>
			<th>TASA DE INTERÉS</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?php echo number_format($monto);  ?> </td>
			<td><?php echo number_format($total);  ?> </td>
			<td><?php echo number_format($interesT);  ?> </td>
			<td><?php echo $nombretasa;  ?> </td>
			<td><?php echo $valortasa;  ?>% </td>
		</tr>
	</tbody>
</table>

<table class="table">
	<thead>
		<tr>
			<th>#</th>
			<th>CUOTA</th>
			<th>INTERES</th>
			<th>CAPITAL</th>
			<th>SALDO</th>
		</tr>
	</thead>
	<tbody>
	@for ($x = 0; $x < $meses; $x++)
	<?php
		$interes = $final*$mes;
		$amort = $cuota - $interes;
		$final = $final - $amort;
		$mesa = $mesa+1;
	?>
		<tr>
			<td><?php echo $mesa;  ?> </td>
			<td><?php echo number_format($cuota);  ?> </td>
			<td><?php echo number_format($interes);?> </td>
			<td><?php echo number_format($amort); ?> </td>
			<td><?php echo number_format($final); ?> </td>
		</tr>
	@endfor
	</tbody>
</table>
@endif
</div>
<div class="form-group">
	<div class="col-md-12">
		*Los resultados son informativos y pueden variar. Por ningún motivo compromete a FONSODI a otorgar efectivamente la operación simulada.
	</div>
</div>
</body>
</html>

<script language="JavaScript">
  var totalTiempo=10;
  var url="dd";
  function updateReloj()
  {
      document.getElementById('CuentaAtras').innerHTML = "La descarga comenzara en  "+totalTiempo+" segundos";
      if(totalTiempo==0){}
      else{
          /* Restamos un segundo al tiempo restante */
          totalTiempo-=1;
          /* Ejecutamos nuevamente la función al pasar 1000 milisegundos (1 segundo) */
          setTimeout("updateReloj()",1000);
      }
  }
</script>
