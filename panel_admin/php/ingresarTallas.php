<?php
include("../../db/Conexion.php");
$siglas = $_POST['siglas'];
$tallas = $_POST['tallas'];
$conexion = new Conexion();
$contar = 0;
$consultaSQL = "INSERT INTO tallas (siglas) values ('$siglas')";
$insert = $conexion->agregarDatos($consultaSQL);
if ($insert == 1) {
    foreach ($tallas as $talla) {
        $contar = $contar + 1;
        $consulta = "UPDATE tallas SET `$contar`='$talla', numTallas=$contar WHERE siglas='$siglas'";
        $update = $conexion->editarDatos($consulta);
    }
}

echo json_encode($update);
