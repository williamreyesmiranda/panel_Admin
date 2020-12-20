<?php
include("../../db/Conexion.php");
$area = $_POST['area'];
$nroPedido = $_POST['nroPedido'];
$idPedido=$_POST['idPedido'];
$conexion = new Conexion();
foreach($idPedido as $pedido){
$consulta = "UPDATE ". $area . " SET estado=1 WHERE pedido='$pedido'";
$update = $conexion->editarDatos($consulta);
}
echo json_encode($update);
?>