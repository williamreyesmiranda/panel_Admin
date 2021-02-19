<?php
session_start();
include("../../db/Conexion.php");
$idPedido = $_POST['idPedido'];
$idTerminacion = $_POST['idTerminacion'];
$unds = $_POST['unds'];
$obs = $_POST['obs'];
$fechaFin = date('Y-m-d');
$usuario = $_SESSION['iduser'];



$conexion = new Conexion();
$consultaSQL =      "UPDATE terminacion SET parcial='$unds', obs_terminacion='$obs',
                     usuario='$usuario', finprocesofecha='$fechaFin', estado=4
                     WHERE pedido='$idPedido';
                     UPDATE pedidos SET estado=4 WHERE idpedido='$idPedido';
                     UPDATE bodega SET estado=4 WHERE pedido='$idPedido';
                     UPDATE corte SET estado=4 WHERE pedido='$idPedido';
                     UPDATE confeccion SET estado=4 WHERE pedido='$idPedido';
                     UPDATE estampacion SET estado=4 WHERE pedido='$idPedido';
                     UPDATE sublimacion SET estado=4 WHERE pedido='$idPedido';
                     UPDATE bordado SET estado=4 WHERE pedido='$idPedido'";
$result = $conexion->editarDatos($consultaSQL);
echo json_encode($result);
