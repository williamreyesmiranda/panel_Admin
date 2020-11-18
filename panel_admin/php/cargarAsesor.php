<?php  
include("../../db/Conexion.php");

$nombreCliente=$_POST['nombreCliente'];
$conexion=new Conexion();
$consulta="SELECT asesor FROM clientes WHERE nombre='$nombreCliente'";
$asesores=$conexion->consultarDatos($consulta);

echo ($asesores[0]['asesor']);
?>