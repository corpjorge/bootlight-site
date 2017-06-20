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
    <div class="form-group">
      <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
      FONDO DE EMPLEADOS DE SODIMAC COLOMBIA FONSODI
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
			<th>TASA NOMINAL MES</th>
			<th>TASA EFECTIVA ANUAL</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?php echo number_format($monto);  ?> </td>
			<td><?php echo number_format($total);  ?> </td>
			<td><?php echo number_format($interes);?> </td>
			<td><?php echo $nombretasa;  ?> </td>
			<td><?php echo $valortasa;  ?>% </td>
			<td><?php echo $valortasaanual;  ?>% </td>
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
			<th>TASA NOMINAL MES</th>
			<th>TASA EFECTIVA ANUAL</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?php echo number_format($monto);  ?> </td>
			<td><?php echo number_format($total);  ?> </td>
			<td><?php echo number_format($interesT);  ?> </td>
			<td><?php echo $nombretasa;  ?> </td>
			<td><?php echo $valortasa;  ?>% </td>
			<td><?php echo $valortasaanual;  ?>% </td>

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
<div class="form-group">
	<div class="col-md-12">
		*Los resultados son informativos y pueden variar. Por ningún motivo compromete a FONSODI a otorgar efectivamente la operación simulada.
	</div>
</div>
</body>
</html>
