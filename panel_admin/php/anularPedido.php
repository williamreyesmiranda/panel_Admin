<?php   
include("../../db/Conexion.php");

$id=$_POST['id'];
$obs = $_POST['value'];


$conexion= new Conexion();
$consultaSQL="UPDATE pedidos SET estado=3, obs_pedido='$obs' WHERE idpedido='$id'";
$result=$conexion->editarDatos($consultaSQL);
echo json_encode($result);


?>