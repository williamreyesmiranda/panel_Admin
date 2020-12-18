<?php   
session_start();
include("../../db/Conexion.php");
$idPedido=$_POST['idPedido'];
$idBordado=$_POST['idBordado'];
$parcial = $_POST['parcial'];
$obs_bordado = $_POST['obs_bordado'];
$logo = $_POST['logo'];
$pte_diseno = $_POST['pte_diseno'];
$num_bordado = $_POST['num_bordado'];
$muestra = $_POST['muestra'];
$punt_unidad = $_POST['punt_unidad'];
$inicioproceso = date('Y-m-d');
$usuario = $_SESSION['iduser'];

$conexion= new Conexion();
$consultaSQL="UPDATE bordado SET parcial='$parcial', obs_bordado='$obs_bordado',
      usuario='$usuario', inicioprocesofecha='$inicioproceso', estado=1, 
      logo='$logo', pte_diseno='$pte_diseno', num_bordado='$num_bordado', muestra='$muestra', punt_unidad='$punt_unidad'
             WHERE idbordado='$idBordado';
             UPDATE pedidos SET estado=1 WHERE idpedido='$idPedido'";
$result=$conexion->editarDatos($consultaSQL);
echo json_encode($result);


?>