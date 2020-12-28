<?php
include("../../db/Conexion.php");
$color = $_POST['color'];

$conexion = new Conexion();
if (empty($color)) {
    $insert=2;
 }else{
    $consultaSQL = "INSERT INTO colores (nombreColor) values ('$color')";
    $insert = $conexion->agregarDatos($consultaSQL);
}

echo json_encode($insert);
