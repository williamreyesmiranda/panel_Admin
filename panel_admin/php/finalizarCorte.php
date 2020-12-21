<?php
session_start();
include("../../db/Conexion.php");
$idPedido = $_POST['idPedido'];
$idCorte = $_POST['idCorte'];
$unds = $_POST['unds'];
$obs = $_POST['obs'];
$fechaFin = date('Y-m-d');
$usuario = $_SESSION['iduser'];

$conexion = new Conexion();
$consultaSQL = "UPDATE corte SET parcial='$unds', obs_corte='$obs',
                   usuario='$usuario', finprocesofecha='$fechaFin', estado=4 
                    WHERE idcorte='$idCorte';
                 UPDATE pedidos SET estCorte='✓', estado=1 WHERE idpedido='$idPedido'";
$result = $conexion->editarDatos($consultaSQL);
echo json_encode($result);
