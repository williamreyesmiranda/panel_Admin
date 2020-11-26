<?php   
include("../../db/Conexion.php");
$idCliente=$_POST['idCliente'];
$documento = $_POST['documento'];
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$asesor = $_POST['asesor'];
$celular = $_POST['celular'];
$correo = $_POST['correo'];

$conexion= new Conexion();
$consultaSQL="UPDATE clientes SET documento='$documento', nombre='$nombre', direccion='$direccion', asesor='$asesor',
      celular='$celular', correo ='$correo'     
             WHERE id_cliente='$idCliente'";
$result=$conexion->editarDatos($consultaSQL);
echo json_encode($result);

?>