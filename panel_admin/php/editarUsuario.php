<?php
include("../../db/Conexion.php");

$idUsuario = $_POST['idUsuario'];
$nombre = $_POST['nombre'];
$cedula = $_POST['cedula'];
$sexo = $_POST['sexo'];
$usuario = $_POST['usuario'];
$clave = $_POST['clave'];
$correo = $_POST['correo'];


$_SESSION['nombre'] = $nombre;
$_SESSION['user'] = $usuario;
$_SESSION['sexo'] = $sexo;
$_SESSION['cedula'] = $cedula;
$_SESSION['clave'] = $clave;
$_SESSION['correo'] = $correo;

$conexion = new Conexion();
$consultaSQL = "UPDATE usuario SET nombre='$nombre', cedula='$cedula', sexo='$sexo', 
            usuario='$usuario', clave='$clave', correo='$correo'
            WHERE idUsuario='$idUsuario'";
$result = $conexion->editarDatos($consultaSQL);
echo json_encode($result);
