<?php 
session_start();
include_once("Conexion.php");
$conexion = new Conexion();

//recepcion de datos enviados mediante POST de ajax
$usuario=(isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$password=(isset($_POST['password'])) ? $_POST['password'] : '';
$pw=md5($password);

$consultaSQL="SELECT u.idusuario, u.nombre, u.usuario, u.cedula, u.sexo , u.rol as 'idrol' ,r.rol FROM usuario u INNER JOIN rol r on u.rol = r.idrol 
WHERE u.usuario= '$usuario' AND u.clave= '$pw' AND u.estatus>=1";
$resultado = $conexion->consultarDatos($consultaSQL);

if($resultado){
     
    $_SESSION['active'] = true;
    $_SESSION['iduser'] = $resultado[0]['idusuario'];
    $_SESSION['nombre'] = $resultado[0]['nombre'];
    $_SESSION['user'] = $resultado[0]['usuario'];
    $_SESSION['idrol'] = $resultado[0]['idrol']; 
    $_SESSION['rol'] = $resultado[0]['rol']; 
    $_SESSION['cedula'] = $resultado[0]['cedula']; 
    $_SESSION['sexo'] = $resultado[0]['sexo']; 
}else{
   print json_encode(-1);
   
}

