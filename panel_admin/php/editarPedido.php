<?php   
include("../../db/Conexion.php");
include("../php/funcionFecha.php");
$idPedido=$_POST['idPedidoEditar'];
$nroPedido = $_POST['nroPedidoEditar'];
$nombreCliente = $_POST['clienteEditar'];
$asesor = $_POST['asesor'];
$fechaInicio = $_POST['fechaInicio'];
$fechaFin = $_POST['fechaFin'];
$unds = $_POST['undsEditar'];
$procesos=$_POST['procesos'];
$diasHabiles=$_POST['diasEditar'];

$conexion= new Conexion();
$consultaSQL="UPDATE pedidos SET num_pedido='$nroPedido', cliente='$nombreCliente', asesor='$asesor', fecha_inicio='$fechaInicio',
      fecha_fin='$fechaFin',  dias_habiles='$diasHabiles', unds='$unds'     
             WHERE idpedido='$idPedido'";
$result=$conexion->editarDatos($consultaSQL);
echo json_encode($result);
//veridicar si se ingresó datos a pedidos para ingresarlos a las áreas
if ($result == 1) {
       //consulta procesos implicados
      $consultaSQL = "SELECT * FROM procesos WHERE idproceso =$procesos";
      $result = $conexion->consultarDatos($consultaSQL);

      #comparacion celda1
      $dato1 = strtolower($result[0]['1']);
      $tiempo1 = $result[0]['tiempo1'];
      $dias1 = round($diasHabiles * $tiempo1);
      $inicio1 = dayToFecha($fechaInicio, 0);
      $final1 = dayToFecha($inicio1, $dias1 - 1);
      $consultaSQL = "UPDATE $dato1 SET iniciofecha='$inicio1', finfecha='$final1', dias='$dias1' WHERE pedido='$idPedido'";
      $insert1 = $conexion->editarDatos($consultaSQL);
      
      #comparacion celda2
      $dato2 = strtolower($result[0]['2']);
      $tiempo2 = $result[0]['tiempo2'];
      $dias2 = round($diasHabiles * $tiempo2);
      $inicio2 = dayToFecha($final1, 1);
      $final2 = dayToFecha($inicio2, $dias2 - 1);
      $consultaSQL = "UPDATE $dato2 SET iniciofecha='$inicio2', finfecha='$final2', dias='$dias2' WHERE pedido='$idPedido'";
      $insert2 = $conexion->editarDatos($consultaSQL);
      
      #comparacion celda3
      $dato3 = strtolower($result[0]['3']);
      $tiempo3 = $result[0]['tiempo3'];
      $dias3 = round($diasHabiles * $tiempo3);
      $inicio3 = dayToFecha($final2, 1);
      $final3 = dayToFecha($inicio3, $dias3 - 1);
      if ($dato3 != '') {
          $consultaSQL = "UPDATE $dato3 SET iniciofecha='$inicio3', finfecha='$final3', dias='$dias3' WHERE pedido='$idPedido'";
          $insert3 = $conexion->editarDatos($consultaSQL);
         }

      #comparacion celda4
      $dato4 = strtolower($result[0]['4']);
      $tiempo4 = $result[0]['tiempo4'];
      $dias4 = round($diasHabiles * $tiempo4);
      $inicio4 = dayToFecha($final3, 1);
      $final4 = dayToFecha($inicio4, $dias4 - 1);
      if ($dato4 != '') {
          $consultaSQL = "UPDATE $dato4 SET iniciofecha='$inicio4', finfecha='$final4', dias='$dias4' WHERE pedido='$idPedido'";
          $insert4 = $conexion->editarDatos($consultaSQL);
               }

      #comparacion celda5
      $dato5 = strtolower($result[0]['5']);
      $tiempo5 = $result[0]['tiempo5'];
      $dias5 = round($diasHabiles * $tiempo5);
      $inicio5 = dayToFecha($final4, 1);
      $final5 = dayToFecha($inicio5, $dias5 - 1);
      if ($dato5 != '') {
          $consultaSQL = "UPDATE $dato5 SET iniciofecha='$inicio5', finfecha='$final5', dias='$dias5' WHERE pedido='$idPedido'";
          $insert5 = $conexion->editarDatos($consultaSQL);
          }

      #comparacion celda6
      $dato6 = strtolower($result[0]['6']);
      $tiempo6 = $result[0]['tiempo6'];
      $dias6 = round($diasHabiles * $tiempo6);
      $inicio6 = dayToFecha($final5, 1);
      $final6 = dayToFecha($inicio6, $dias6 - 1);
      if ($dato6 != '') {
        $consultaSQL = "UPDATE $dato6 SET iniciofecha='$inicio6', finfecha='$final6', dias='$dias6' WHERE pedido='$idPedido'";
        $insert5 = $conexion->editarDatos($consultaSQL);
      }

      $consultaSQL = "UPDATE terminacion SET finfecha='$fechaFin' WHERE pedido='$idPedido'";
        $fechaTerminacion = $conexion->editarDatos($consultaSQL);
  }

?>