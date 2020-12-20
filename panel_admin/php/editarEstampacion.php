<?php   
session_start();
include("../../db/Conexion.php");
$idPedido=$_POST['idPedido'];
$idEstampacion=$_POST['idEstampacion'];
$parcial = $_POST['parcial'];
$obs_estampacion = $_POST['obs_estampacion'];
$arte_diseno=$_POST['arte_diseno'];
$arte_impresion=$_POST['arte_impresion'];
$grabacion=$_POST['grabacion'];
$estampacion=$_POST['estampacion'];
$sublimacion=$_POST['sublimacion'];
$tecnica=$_POST['tecnica'];
$nro_diseno=$_POST['nro_diseno'];
$posicion=$_POST['posicion'];
$seda=$_POST['seda'];
$nro_plancha=$_POST['nro_plancha'];
$fren=$_POST['fren'];
$esp=$_POST['esp'];
$otro=$_POST['otro'];
$prep=$_POST['prep'];
$est=$_POST['est'];
$sub=$_POST['sub'];
$inicioproceso = date('Y-m-d');
$usuario = $_SESSION['iduser'];

$conexion= new Conexion();
$consultaSQL="UPDATE estampacion SET parcial='$parcial', obs_estampacion='$obs_estampacion',
      usuario='$usuario', inicioprocesofecha='$inicioproceso', estado=1, arte_diseno='$arte_diseno',arte_impresion='$arte_impresion',
      grabacion='$grabacion', estampacion='$estampacion', sublimacion='$sublimacion', tecnica='$tecnica',
      nro_diseno='$nro_diseno',posicion='$posicion',seda='$seda',nro_plancha='$nro_plancha',
      fren='$fren',esp='$esp',otro='$otro',prep='$prep',est='$est',sub='$sub'
             WHERE idestampacion='$idEstampacion';
             UPDATE pedidos SET estado=1 WHERE idpedido='$idPedido'";
$result=$conexion->editarDatos($consultaSQL);
echo json_encode($result);


?>