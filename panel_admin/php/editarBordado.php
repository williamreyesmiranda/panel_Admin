<?php   
session_start();
include("../../db/Conexion.php");
$idPedido=$_POST['idPedido'];
$idBordado=$_POST['idBordado'];
$parcial = $_POST['parcial'];
$obs_bordado = $_POST['obs_bordado'];
$inicioproceso = date('Y-m-d');
$usuario = $_SESSION['iduser'];

$conexion= new Conexion();
$consultaSQL="UPDATE bordado SET parcial='$parcial', obs_bordado='$obs_bordado',
      usuario='$usuario', inicioprocesofecha='$inicioproceso', estado=1
             WHERE idbordado='$idBordado';
             UPDATE pedidos SET estado=1 WHERE idpedido='$idPedido'";
$result=$conexion->editarDatos($consultaSQL);
echo json_encode($result);


?>