<?php
$mysqli = new mysqli("localhost", "fonsodi_sql", ".[OPFuunZ.+8%%ttTQ23#$%%$$%pP", "fonsodi_portal");
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$fecDesc = date("Ymd");
header("Content-Type: text/plain");
header('Content-Disposition: attachment; filename="servicios'.$fecDesc.'.txt"');


$consulta = "SELECT a.cedula, a.monto, a.cuotas, b.linea, b.nit, DATE_FORMAT(a.desembolsado, '%d/%m/%Y') , b.destinacion  
FROM p_solicitudes a LEFT JOIN p_productos b ON(a.p_productos_id=b.id) WHERE a.estados_id=6 AND b.tipo = 2";
if ($resultado = $mysqli->query($consulta)) 
{
    while ($fila = $resultado->fetch_row()) 
	{
		
        echo "".$fila[0]."	|	".$fila[1]."	|	".$fila[2]."	|	".$fila[5]."	|	".$fila[3]."	|	1	|	".$fila[6]."	|	2	|	".$fila[4]."\r\n";
    }
    $resultado->close();
}

?>