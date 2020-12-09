<?php
session_start();
include("../../db/Conexion.php");
$idPedido = $_POST['idPedido'];
$idEstampacion = $_POST['idEstampacion'];
$unds = $_POST['unds'];
$obs = $_POST['obs'];
$fechaFin = date('Y-m-d');
$usuario = $_SESSION['iduser'];

$conexion = new Conexion();
$consultaSQL = "UPDATE estampacion SET parcial='$unds', obs_estampacion='$obs',
                   usuario='$usuario', finprocesofecha='$fechaFin', estado=4
                    WHERE idestampacion='$idEstampacion';
                 UPDATE pedidos SET estEstampacion='X' WHERE idpedido='$idPedido';";
$result = $conexion->editarDatos($consultaSQL);
echo json_encode($result);
