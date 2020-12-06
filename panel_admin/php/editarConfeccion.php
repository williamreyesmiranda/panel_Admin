<?php   
session_start();
include("../../db/Conexion.php");
$idPedido=$_POST['idPedido'];
$idConfeccion=$_POST['idConfeccion'];
$parcial = $_POST['parcial'];
$obs_confeccion = $_POST['obs_confeccion'];
$inicioproceso = date('Y-m-d');
$usuario = $_SESSION['iduser'];
$entrega=@$_POST['entrega'];

$conexion= new Conexion();
$consultaSQL="UPDATE confeccion SET parcial='$parcial', obs_confeccion='$obs_confeccion',
      usuario='$usuario', inicioprocesofecha='$inicioproceso', estado=1, entrega='$entrega'
             WHERE idconfeccion='$idConfeccion';
             UPDATE pedidos SET estado=1 WHERE idpedido='$idPedido'";
$result=$conexion->editarDatos($consultaSQL);
echo json_encode($result);
?>