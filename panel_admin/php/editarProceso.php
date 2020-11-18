<?php
session_start();

include("../../db/Conexion.php");
include("../php/funcionFecha.php");
if (empty($_SESSION['active'])) {
    header('location: ../');
} else {
    $idPedido = $_POST['idPedido']; //ok
    $nroPedido = $_POST['nroPedido']; //ok
    $nombreCliente = $_POST['clienteEditar'];
    $asesor = $_POST['asesor']; //ok
    $fechaInicio = $_POST['fechaInicio']; //ok
    $fechaFin = $_POST['fechaFin']; //ok
    $unds = $_POST['undsEditar']; //ok
    $procesos = $_POST['procesosProceso']; //ok
    $idUsuario = $_SESSION['iduser'];
    $diasHabiles = $_POST['diasEditar']; //ok

    $conexion = new Conexion();
    $consultaSQL = "DELETE FROM bodega WHERE pedido= '$idPedido';
                    DELETE FROM corte WHERE pedido= '$idPedido';
                    DELETE FROM confeccion WHERE pedido= '$idPedido';
                    DELETE FROM estampacion WHERE pedido= '$idPedido';
                    DELETE FROM sublimacion WHERE pedido= '$idPedido';
                    DELETE FROM bordado WHERE pedido= '$idPedido';
                    DELETE FROM terminacion WHERE pedido= '$idPedido';
                    DELETE FROM pedidos WHERE idpedido= '$idPedido';";
    $conexion->eliminarDatos($consultaSQL);
    //eliminar en la base de datos los procesos implicados
    $consultaSQL = "SELECT * FROM procesos WHERE siglas='$procesos'";
    $result = $conexion->consultarDatos($consultaSQL);
    $idProceso = $result[0]['idproceso'];
    //ingresar datos a tabla pedidos
    $consultaSQL = ("INSERT INTO pedidos(num_pedido,cliente, fecha_inicio, fecha_fin, dias_habiles, procesos, unds, asesor, usuario)
        values('$nroPedido','$nombreCliente','$fechaInicio','$fechaFin','$diasHabiles','$idProceso','$unds', '$asesor', '$idUsuario')");
    $insert = $conexion->agregarDatos($consultaSQL);
    echo json_encode($insert);
    //veridicar si se ingresó datos a pedidos para ingresarlos a las áreas
    if ($insert == 1) {

        //consultar id maximo de pedido
        $consultaSQL = "SELECT max(idpedido) as 'maxpedido' FROM pedidos";
        $result = $conexion->consultarDatos($consultaSQL);
        $maxPedido = $result[0]['maxpedido'];
        //consulta procesos implicados
        $consultaSQL = "SELECT * FROM procesos WHERE idproceso =$idProceso";
        $result = $conexion->consultarDatos($consultaSQL);
        $alert = "";
        #comparacion celda1
        $dato1 = strtolower($result[0]['1']);
        $tiempo1 = $result[0]['tiempo1'];
        $dias1 = round($diasHabiles * $tiempo1);
        $inicio1 = dayToFecha($fechaInicio, 0);
        $final1 = dayToFecha($inicio1, $dias1 - 1);
        $consultaSQL = "INSERT INTO $dato1(pedido, iniciofecha, finfecha, dias) VALUES ('$maxPedido','$inicio1','$final1', $dias1)";
        $insert1 = $conexion->agregarDatos($consultaSQL);
        if ($insert1 == 1) {
            $alert .= "<script> alertify.success('Ingresado a " . $dato1 . "'); </script>";
        }
        #comparacion celda2
        $dato2 = strtolower($result[0]['2']);
        $tiempo2 = $result[0]['tiempo2'];
        $dias2 = round($diasHabiles * $tiempo2);
        $inicio2 = dayToFecha($final1, 1);
        $final2 = dayToFecha($inicio2, $dias2 - 1);
        $consultaSQL = "INSERT INTO $dato2(pedido, iniciofecha, finfecha, dias) VALUES ('$maxPedido','$inicio2','$final2', $dias2)";
        $insert2 = $conexion->agregarDatos($consultaSQL);
        if ($insert2 == 1) {
            $alert .= "<script> alertify.success('Ingresado a " . $dato2 . "'); </script>";
        } else {
            $alert .= "<script> alertify.error('Error al ingresar en " . $dato2 . "'); </script>";
        }
        #comparacion celda3
        $dato3 = strtolower($result[0]['3']);
        $tiempo3 = $result[0]['tiempo3'];
        $dias3 = round($diasHabiles * $tiempo3);
        $inicio3 = dayToFecha($final2, 1);
        $final3 = dayToFecha($inicio3, $dias3 - 1);
        if ($dato3 != '') {
            $consultaSQL = "INSERT INTO $dato3(pedido, iniciofecha, finfecha, dias) VALUES ('$maxPedido','$inicio3','$final3', $dias3)";
            $insert3 = $conexion->agregarDatos($consultaSQL);
            if ($insert3 == 1) {
                $alert .= "<script> alertify.success('Ingresado a " . $dato3 . "'); </script>";
            } else {
                $alert .= "<script> alertify.error('Error al ingresar en " . $dato3 . "'); </script>";
            }
        }

        #comparacion celda4
        $dato4 = strtolower($result[0]['4']);
        $tiempo4 = $result[0]['tiempo4'];
        $dias4 = round($diasHabiles * $tiempo4);
        $inicio4 = dayToFecha($final3, 1);
        $final4 = dayToFecha($inicio4, $dias4 - 1);
        if ($dato4 != '') {
            $consultaSQL = "INSERT INTO $dato4(pedido, iniciofecha, finfecha, dias) VALUES ('$maxPedido','$inicio4','$final4', $dias4)";
            $insert4 = $conexion->agregarDatos($consultaSQL);
            if ($insert4 == 1) {
                $alert .= "<script> alertify.success('Ingresado a " . $dato4 . "'); </script>";
            } else {
                $alert .= "<script> alertify.error('Error al ingresar en " . $dato4 . "'); </script>";
            }
        }

        #comparacion celda5
        $dato5 = strtolower($result[0]['5']);
        $tiempo5 = $result[0]['tiempo5'];
        $dias5 = round($diasHabiles * $tiempo5);
        $inicio5 = dayToFecha($final4, 1);
        $final5 = dayToFecha($inicio5, $dias5 - 1);
        if ($dato5 != '') {
            $consultaSQL = "INSERT INTO $dato5(pedido, iniciofecha, finfecha, dias) VALUES ('$maxPedido','$inicio3','$final5', $dias5)";
            $insert5 = $conexion->agregarDatos($consultaSQL);
            if ($insert5 == 1) {
                $alert .= "<script> alertify.success('Ingresado a " . $dato5 . "'); </script>";
            } else {
                $alert .= "<script> alertify.error('Error al ingresar en " . $dato5 . "'); </script>";
            }
        }

        #comparacion celda6
        $dato6 = strtolower($result[0]['6']);
        $tiempo6 = $result[0]['tiempo6'];
        $dias6 = round($diasHabiles * $tiempo6);
        $inicio6 = dayToFecha($final5, 1);
        $final6 = dayToFecha($inicio6, $dias6 - 1);
        if ($dato6 != '') {
            $consultaSQL = "INSERT INTO $dato3(pedido, iniciofecha, finfecha, dias) VALUES ('$maxPedido','$inicio6','$final6', $dias6)";
            $insert6 = $conexion->agregarDatos($consultaSQL);
            if ($insert6 == 1) {
                $alert .= "<script> alertify.success('Ingresado a " . $dato6 . "'); </script>";
            } else {
                $alert .= "<script> alertify.error('Error al ingresar en " . $dato6 . "'); </script>";
            }
        }
    }
}
