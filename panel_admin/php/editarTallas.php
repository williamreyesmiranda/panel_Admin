<?php
include("../../db/Conexion.php");
$idTalla=$_POST['idTalla'];
$siglas = $_POST['siglas'];
$tallas = $_POST['tallas'];
$conexion = new Conexion();
$contar = 0;
  foreach ($tallas as $talla) {
        $contar = $contar + 1;
        $consulta = "UPDATE tallas SET `$contar`='$talla', numTallas=$contar, siglas='$siglas' WHERE idTalla=$idTalla";
        $update = $conexion->editarDatos($consulta);
    }


echo json_encode($update);
