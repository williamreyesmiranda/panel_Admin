<?php   
session_start();
include("../../db/Conexion.php");
$idPedido=$_POST['idPedido'];
$idSublimacion=$_POST['idSublimacion'];
$parcial = $_POST['parcial'];
$obs_sublimacion = $_POST['obs_sublimacion'];
$inicioproceso = date('Y-m-d');
$usuario = $_SESSION['iduser'];

$conexion= new Conexion();
$consultaSQL="UPDATE sublimacion SET parcial='$parcial', obs_sublimacion='$obs_sublimacion',
      usuario='$usuario', inicioprocesofecha='$inicioproceso', estado=1
             WHERE idsublimacion='$idSublimacion';
             UPDATE pedidos SET estado=1 WHERE idpedido='$idPedido'";
$result=$conexion->editarDatos($consultaSQL);
echo json_encode($result);


?>