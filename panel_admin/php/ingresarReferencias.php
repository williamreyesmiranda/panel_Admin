<?php
include("../../db/Conexion.php");
$codigo = $_POST['codigo'];
$descripcion = $_POST['descripcion'];
$talla = $_POST['talla'];
$correo = $_POST['correo'];
if (empty($codigo) && empty($descripcion) && empty($talla) && empty($correo)) {
    $insert = 2;
} else {
    $conexion = new Conexion();
    $consultaSQL = "INSERT INTO referencias (codigo, descripcion, correo, talla) values ('$codigo','$descripcion','$correo','$talla')";
    $insert = $conexion->agregarDatos($consultaSQL);
}
echo json_encode($insert);
