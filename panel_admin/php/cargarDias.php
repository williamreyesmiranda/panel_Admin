<?php  
include("funcionFecha.php");
$fechaInicio=$_POST['fechaInicio'];
$fechaFin=$_POST['fechaFin'];

echo fechaToDays($fechaInicio,$fechaFin);
?>