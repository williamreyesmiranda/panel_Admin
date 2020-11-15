<?php   
include("../../db/Conexion.php");
include("../php/funcionFecha.php");
$idPedido=$_POST['idPedido'];
$nroPedido = $_POST['nroPedido'];
$nombreCliente = $_POST['nombreCliente'];
$asesor = $_POST['asesor'];
$fechaInicio = $_POST['fechaInicio'];
$fechaFin = $_POST['fechaFin'];
$unds = $_POST['unds'];
$procesos = $_POST['procesos'];

$conexion= new Conexion();
$consultaSQL="UPDATE pedidos SET num_pedido='$nroPedido', iniciofecha='$fechaInicio', infecha='$fechaFin'
             WHERE idpedido='$idPedido'";
$result=$conexion->editarDatos($consultaSQL);
echo json_encode($result);


?>