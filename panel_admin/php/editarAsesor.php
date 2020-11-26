<?php   
include("../../db/Conexion.php");
$idAsesor=$_POST['idAsesor'];
$nombre = $_POST['nombre'];
$usuario = $_POST['usuario'];
$celular = $_POST['celular'];
$correo = $_POST['correo'];

$conexion= new Conexion();
$consultaSQL="UPDATE asesor SET nombre='$nombre', usuario='$usuario',
      celular='$celular', correo ='$correo'     
             WHERE idasesor='$idAsesor'";
$result=$conexion->editarDatos($consultaSQL);
echo json_encode($result);

?>