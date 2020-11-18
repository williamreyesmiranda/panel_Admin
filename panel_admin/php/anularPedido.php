<?php   
include("../../db/Conexion.php");

$id=$_POST['id'];
$obs = $_POST['obs'];


$conexion= new Conexion();
$consultaSQL="UPDATE pedidos SET estado=3, obs_pedido='$obs' WHERE idpedido='$id';
                UPDATE bodega SET estado=3, obs_bodega='$obs'WHERE pedido='$id';
                UPDATE corte SET estado=3, obs_corte='$obs'WHERE pedido='$id';
                UPDATE confeccion SET estado=3, obs_confeccion='$obs'WHERE pedido='$id';
                UPDATE bordado SET estado=3, obs_bordado='$obs'WHERE pedido='$id';
                UPDATE terminacion SET estado=3, obs_terminacion='$obs'WHERE pedido='$id';
                UPDATE estampacion SET estado=3, obs_estampacion='$obs'WHERE pedido='$id';
                UPDATE sublimacion SET estado=3, obs_sublimacion='$obs'WHERE pedido='$id';";
$result=$conexion->editarDatos($consultaSQL);
echo json_encode($result);


?>