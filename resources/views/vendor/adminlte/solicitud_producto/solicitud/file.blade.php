<?php
$mysqli = new mysqli("localhost", "fonsodi_sql", ".[OPFuunZ.+8%%ttTQ23#$%%$$%pP", "fonsodi_portal");
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$fecDesc = date("Ymd");
header("Content-Type: text/plain");
header('Content-Disposition: attachment; filename="creditos'.$fecDesc.'.txt"');


$consulta = "SELECT p.cod_asociado, p.account_type, p.account, b.code, DATE_FORMAT(opening, '%d/%m/%Y')
                FROM p_solicitudes as p 
                INNER JOIN p_productos as m
                ON m.id = p.p_productos_id
                INNER JOIN banks as b
                ON b.id = p.bank_id
                WHERE p.estados_id=6 AND m.tipo = 1 ";


if ($resultado = $mysqli->query($consulta)) 
{
    /**
    * account_type, 0 para ahorros y 1 para corriente
    * code, campo en la tabla p_solicitudes para traer el codigo de los bancos
    * relacionado con la solicitud que se hace
    * opening, fecha de apertura de cuenta
    */
    while ($fila = $resultado->fetch_row()) 
	{
        echo "".$fila[0]."	|	".$fila[1]."	|	".$fila[2]."	|	".$fila[3]."	|	1	|	".$fila[4]."	|	1\r\n";
    }
    $resultado->close();
}

?>