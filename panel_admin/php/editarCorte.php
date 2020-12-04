<?php   
session_start();
include("../../db/Conexion.php");
$idPedido=$_POST['idPedido'];
$idCorte=$_POST['idCorte'];
$parcial = $_POST['parcial'];
$obs_corte = $_POST['obs_corte'];
$inicioproceso = date('Y-m-d');
$usuario = $_SESSION['iduser'];

$conexion= new Conexion();
$consultaSQL="UPDATE corte SET parcial='$parcial', obs_corte='$obs_corte',
      usuario='$usuario', inicioprocesofecha='$inicioproceso', estado=1
             WHERE idcorte='$idCorte';
             UPDATE pedidos SET estado=1 WHERE idpedido='$idPedido'";
$result=$conexion->editarDatos($consultaSQL);
echo json_encode($result);


?>