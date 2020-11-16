<?php   
include("../../db/Conexion.php");
include("../php/funcionFecha.php");
$idPedido=$_POST['idPedidoEditar'];
$nroPedido = $_POST['nroPedidoEditar'];
$nombreCliente = $_POST['clienteEditar'];
$asesor = $_POST['asesor'];
$fechaInicio = $_POST['inicioEditar'];
$fechaFin = $_POST['finEditar'];
$unds = $_POST['undsEditar'];
$diasHabiles=fechaToDays($fechaInicio,$fechaFin);

$conexion= new Conexion();
$consultaSQL="UPDATE pedidos SET num_pedido='$nroPedido', iniciofecha='$fechaInicio', infecha='$fechaFin'
             WHERE idpedido='$idPedido'";
$result=$conexion->editarDatos($consultaSQL);
echo json_encode($result);


?>