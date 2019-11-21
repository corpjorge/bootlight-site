<?php
$mysqli = new mysqli("localhost", "fonsodi_sql", ".[OPFuunZ.+8%%ttTQ23#$%%$$%pP", "fonsodi_portal");
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$fecDesc = date("Ymd");
header("Content-Type: text/plain");
header('Content-Disposition: attachment; filename="productos'.$fecDesc.'.txt"');

$consulta = "SELECT a.cedula, a.monto, a.cuotas, b.linea, b.nit, a.desembolsado, b.destinacion  FROM p_solicitudes a LEFT JOIN p_productos b ON(a.p_productos_id=b.id) WHERE a.estados_id=6";
if ($resultado = $mysqli->query($consulta)) 
{
    while ($fila = $resultado->fetch_row()) 
	{
		$dia = substr($fila[5],8,2);
		$mes = substr($fila[5],5,2);
		$anio = substr($fila[5],0,4);
						
		if($dia<=20)
		{
			$fecPP  = "30/".$mes."/".$anio;
		}
		else
		{
		 $nuevafecha = strtotime ( '+1 month' , strtotime ( $fila[5] ) ) ;
		 $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
		 $dia = substr($nuevafecha,8,2);
		 $mes = substr($nuevafecha,5,2);
		 $anio = substr($nuevafecha,0,4);
		 $fecPP  = "30/".$mes."/".$anio;		 
		}
		
        echo "".$fila[0]."	|	".$fila[1]."	|	".$fila[2]."	|	".$fecPP."	|	".$fila[3]."	|	1	|	".$fila[6]."	|	1	|	".$fila[3]."\r\n";
    }
    $resultado->close();
}
?>