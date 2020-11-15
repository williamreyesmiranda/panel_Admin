<?php 
session_start();
include_once("Conexion.php");
$objeto = new Conexion();
$conexion=$objeto->Conectar();
//recepcion de datos enviados mediante POST de ajax
$correo=(isset($_POST['correo'])) ? $_POST['correo'] : '';

$consulta="SELECT * FROM usuario WHERE correo='$correo' ";
$resultado=$conexion->prepare($consulta);
$resultado->execute();
if($resultado->rowCount()>0){
     $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
     
}else{
      
   print json_encode(-1);
}
$conexion=null;
 
?> 