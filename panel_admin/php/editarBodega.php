<?php   
session_start();
include("../../db/Conexion.php");
$idPedido=$_POST['idPedido'];
$idBodega=$_POST['idBodega'];
$parcial = $_POST['parcial'];
$obs_bodega = $_POST['obs_bodega'];
$inicioproceso = date('Y-m-d');
$usuario = $_SESSION['iduser'];

$conexion= new Conexion();
$consultaSQL="UPDATE bodega SET parcial='$parcial', obs_bodega='$obs_bodega',
      usuario='$usuario', inicioprocesofecha='$inicioproceso', estado=1
             WHERE idbodega='$idBodega';
             UPDATE pedidos SET estado=1 WHERE idpedido='$idPedido'";
$result=$conexion->editarDatos($consultaSQL);
echo json_encode($result);


?>