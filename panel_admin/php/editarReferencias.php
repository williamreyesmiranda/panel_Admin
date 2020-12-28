<?php
include("../../db/Conexion.php");
$idReferencia = $_POST['idReferencia'];
$codigo = $_POST['codigo'];
$descripcion = $_POST['descripcion'];
$talla = $_POST['talla'];
$correo = $_POST['correo'];

$conexion = new Conexion();
$consultaSQL = "UPDATE referencias  SET codigo='$codigo', descripcion='$descripcion', 
                correo='$correo', talla='$talla' WHERE idReferencia='$idReferencia'";
$insert = $conexion->editarDatos($consultaSQL);


echo json_encode($insert);
