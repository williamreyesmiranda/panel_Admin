<?php
session_start();
include("../../db/Conexion.php");
$idPedido = $_POST['idPedido'];
$idConfeccion = $_POST['idConfeccion'];
$unds = $_POST['unds'];
$obs = $_POST['obs'];
$fechaFin = date('Y-m-d');
$usuario = $_SESSION['iduser'];

$conexion = new Conexion();
$consultaSQL = "UPDATE confeccion SET parcial='$unds', obs_confeccion='$obs',
                   usuario='$usuario', finprocesofecha='$fechaFin', estado=4, entrega='✓'
                    WHERE idconfeccion='$idConfeccion';
                 UPDATE pedidos SET estConfeccion='✓', estado=1 WHERE idpedido='$idPedido';";
$result = $conexion->editarDatos($consultaSQL);
echo json_encode($result);
