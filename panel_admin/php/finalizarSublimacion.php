<?php
session_start();
include("../../db/Conexion.php");
$idPedido = $_POST['idPedido'];
$idSublimacion = $_POST['idSublimacion'];
$unds = $_POST['unds'];
$obs = $_POST['obs'];
$fechaFin = date('Y-m-d');
$usuario = $_SESSION['iduser'];

$conexion = new Conexion();
$consultaSQL = "UPDATE sublimacion SET parcial='$unds', obs_sublimacion='$obs',
                   usuario='$usuario', finprocesofecha='$fechaFin', estado=4 
                    WHERE idsublimacion='$idSublimacion';
                 UPDATE pedidos SET estSublimacion='✓', estado=1 WHERE idpedido='$idPedido'";
$result = $conexion->editarDatos($consultaSQL);
echo json_encode($result);
