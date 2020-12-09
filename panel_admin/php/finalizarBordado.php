<?php
session_start();
include("../../db/Conexion.php");
$idPedido = $_POST['idPedido'];
$idBordado = $_POST['idBordado'];
$unds = $_POST['unds'];
$obs = $_POST['obs'];
$fechaFin = date('Y-m-d');
$usuario = $_SESSION['iduser'];

$conexion = new Conexion();
$consultaSQL = "UPDATE bordado SET parcial='$unds', obs_bordado='$obs',
                   usuario='$usuario', finprocesofecha='$fechaFin', estado=4 
                    WHERE idbordado='$idBordado';
                 UPDATE pedidos SET estBordado='X' WHERE idpedido='$idPedido'";
$result = $conexion->editarDatos($consultaSQL);
echo json_encode($result);
