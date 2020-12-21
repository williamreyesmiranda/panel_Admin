<?php
session_start();
include("../../db/Conexion.php");
$idPedido = $_POST['idPedido'];
$idBodega = $_POST['idBodega'];
$unds = $_POST['unds'];
$obs = $_POST['obs'];
$fechaFin = date('Y-m-d');
$usuario = $_SESSION['iduser'];

$conexion = new Conexion();
$consultaSQL = "UPDATE bodega SET parcial='$unds', obs_bodega='$obs',
                   usuario='$usuario', finprocesofecha='$fechaFin', estado=4, entrega='✓'
                    WHERE idbodega='$idBodega';
                 UPDATE pedidos SET estBodega='✓', estado=1 WHERE idpedido='$idPedido';";
$result = $conexion->editarDatos($consultaSQL);
echo json_encode($result);
