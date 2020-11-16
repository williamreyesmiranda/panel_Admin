<?php   
include("../../db/Conexion.php");
include("../php/funcionFecha.php");
$idPedido=$_POST['idPedidoEditar'];
$nroPedido = $_POST['nroPedidoEditar'];
$nombreCliente = $_POST['clienteEditar'];
$asesor = $_POST['asesor'];
$fechaInicio = $_POST['fechaInicio'];
$fechaFin = $_POST['fechaFin'];
$unds = $_POST['undsEditar'];
$diasHabiles=$_POST['diasEditar'];

$conexion= new Conexion();
$consultaSQL="UPDATE pedidos SET num_pedido='$nroPedido', cliente='$nombreCliente', asesor='$asesor', fecha_inicio='$fechaInicio',
      fecha_fin='$fechaFin',  dias_habiles='$diasHabiles', unds='$unds'     
             WHERE idpedido='$idPedido'";
$result=$conexion->editarDatos($consultaSQL);
echo json_encode($result);


?>