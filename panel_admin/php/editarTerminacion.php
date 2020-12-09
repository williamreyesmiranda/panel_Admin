<?php   
session_start();
include("../../db/Conexion.php");
$idPedido=$_POST['idPedido'];
$idTerminacion=$_POST['idTerminacion'];
$parcial = $_POST['parcial'];
$obs_terminacion = $_POST['obs_terminacion'];
$inicioproceso = date('Y-m-d');
$usuario = $_SESSION['iduser'];

$conexion= new Conexion();
$consultaSQL="UPDATE terminacion SET parcial='$parcial', obs_terminacion='$obs_terminacion',
      usuario='$usuario', inicioprocesofecha='$inicioproceso', estado=1
             WHERE idterminacion='$idTerminacion';
             UPDATE pedidos SET estado=1 WHERE idpedido='$idPedido'";
$result=$conexion->editarDatos($consultaSQL);
echo json_encode($result);


?>