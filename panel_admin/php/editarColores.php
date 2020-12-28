<?php
include("../../db/Conexion.php");
$idColor = $_POST['idColor'];
$nombreColor = $_POST['color'];

$conexion = new Conexion();
$consultaSQL = "UPDATE colores  SET nombreColor='$nombreColor'WHERE idColor='$idColor'";
$insert = $conexion->editarDatos($consultaSQL);


echo json_encode($insert);
