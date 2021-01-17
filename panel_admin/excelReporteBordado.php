<!DOCTYPE html>
<html lang="es">
<?php
date_default_timezone_set('America/Bogota');
header("Pragma: public");
header("Expires: 0");
$filename = "Reporte_Bordado " . date('Y-m-d H-i-s') . ".xls";
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");


session_set_cookie_params(60 * 60 * 24);
session_start();
include("../db/Conexion.php");
include("php/funcionFecha.php");

?>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>REPORTE BORDADO</title>
    <link rel="shortcut icon" href="images/icono.png" />
   
</head>


<body class="sb-nav-fixed ">

       <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                
                <?php
                $hoy = date('Y-m-d');
                $tresDias = dayToFecha($hoy, 3);
                $conexion = new Conexion();
                ?>
                <div class="accordion" id="accordionExample">
                    <!-- botones para acordeon -->
                    <div class="alert alert-secondary">
                        <h1 class="text-center">INFORME DE BORDADO <?php echo date('d-m-Y');?></h1>
                    </div>
                    <div class="row mb-3 mt-3 px-0 h-100">

                        <div class="col-xl-3 col-md-6 mb-2" style="border:1px solid black">ATRASADOS
                            <div class="card h-100 bg-danger text-white mb-1 ">
                                <?php
                                $consultaSQL = "SELECT count(bo.idbordado) as 'contar', sum(pe.unds) as 'unds', sum(bo.parcial) as 'parcial'  FROM bordado bo
                                INNER JOIN pedidos pe ON pe.idpedido=bo.pedido
                                WHERE bo.estado<3 AND bo.finfecha < '$hoy'";
                                $pedidos = $conexion->consultarDatos($consultaSQL);
                                $contar = $pedidos[0]['contar'];
                                $unds = $pedidos[0]['unds'];
                                $parcial = $pedidos[0]['parcial'];
                                $falta = $unds - $parcial;
                                //contar si confeccion y bodega tiene producto
                                $producto = 0;
                                $horas = 0;
                                $consultaSQL = "SELECT * FROM bordado WHERE estado<3 AND finfecha < '$hoy'";
                                $pedidos = $conexion->consultarDatos($consultaSQL);
                                foreach ($pedidos as $pedido) {
                                    $idPedido = $pedido['pedido'];
                                    $consultaSQL = "SELECT * FROM bodega WHERE pedido=$idPedido AND entrega<>''";
                                    $prod_bodega = $conexion->consultarDatos($consultaSQL);
                                    if ($prod_bodega) {
                                        $producto++;
                                    }
                                    $consultaSQL = "SELECT * FROM confeccion WHERE pedido=$idPedido AND entrega<>''";
                                    $prod_confeccion = $conexion->consultarDatos($consultaSQL);
                                    if ($prod_confeccion) {
                                        $producto++;
                                    }
                                    //sumar tiempos
                                    $consultaSQL = "SELECT * FROM pedidos WHERE idpedido=$idPedido";
                                    $consulta = $conexion->consultarDatos($consultaSQL);
                                    $undsBordado = $consulta[0]['unds'];
                                    $falta = $undsBordado - $pedido['parcial'];
                                    $horas = $horas + round($falta * $pedido['punt_unidad'] / 66600, 2);
                                }
                                $turnos = round($horas / 8.25, 2);
                                ?>
                                <div class="card-header"><?php echo $contar . " pedidos.  (" . $producto . " con producto). <br> Unds Totales:" .
                                                                $unds . " (" . $parcial . " unds Listas). <br> Unds Faltantes: " . $falta . "<br> Horas Totales: " . $horas . "<br> Total Turnos: " . $turnos; ?>
                                </div>
                                </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-2" style="border:1px solid black"> 0 A 3 DIAS
                            <div class="card h-100 bg-warning text-dark mb-1">
                                <?php
                                $consultaSQL = "SELECT count(bo.idbordado) as 'contar', sum(pe.unds) as 'unds', sum(bo.parcial) as 'parcial'  FROM bordado bo
                                INNER JOIN pedidos pe ON pe.idpedido=bo.pedido
                                WHERE bo.estado<3 AND bo.finfecha BETWEEN '$hoy' AND '$tresDias'";
                                $pedidos = $conexion->consultarDatos($consultaSQL);
                                $contar = $pedidos[0]['contar'];
                                $unds = $pedidos[0]['unds'];
                                $parcial = $pedidos[0]['parcial'];
                                $falta = $unds - $parcial;
                                //contar si confeccion y bodega tiene producto
                                $producto = 0;
                                $horas = 0;
                                $consultaSQL = "SELECT * FROM bordado WHERE estado<3 AND finfecha BETWEEN '$hoy' AND '$tresDias'";
                                $pedidos = $conexion->consultarDatos($consultaSQL);
                                foreach ($pedidos as $pedido) {
                                    $idPedido = $pedido['pedido'];
                                    $consultaSQL = "SELECT * FROM bodega WHERE pedido=$idPedido AND entrega<>''";
                                    $prod_bodega = $conexion->consultarDatos($consultaSQL);
                                    if ($prod_bodega) {
                                        $producto++;
                                    }
                                    $consultaSQL = "SELECT * FROM confeccion WHERE pedido=$idPedido AND entrega<>''";
                                    $prod_confeccion = $conexion->consultarDatos($consultaSQL);
                                    if ($prod_confeccion) {
                                        $producto++;
                                    }
                                    //sumar tiempos
                                    $consultaSQL = "SELECT * FROM pedidos WHERE idpedido=$idPedido";
                                    $consulta = $conexion->consultarDatos($consultaSQL);
                                    $undsBordado = $consulta[0]['unds'];
                                    $falta = $undsBordado - $pedido['parcial'];
                                    $horas = $horas + round($falta * $pedido['punt_unidad'] / 66600, 2);
                                }
                                $turnos = round($horas / 8.25, 2);
                                ?>
                                <div class="card-header"><?php echo $contar . " pedidos.  (" . $producto . " con producto). <br> Unds Totales:" .
                                                                $unds . " (" . $parcial . " unds Listas). <br> Unds Faltantes: " . $falta . "<br> Horas Totales: " . $horas . "<br> Total Turnos: " . $turnos; ?>
                                </div>
                               
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-2" style="border:1px solid black"> 4 DIAS EN ADELANTE
                            <div class="card h-100 bg-success text-white mb-1">
                                <?php
                                $consultaSQL = "SELECT count(bo.idbordado) as 'contar', sum(pe.unds) as 'unds', sum(bo.parcial) as 'parcial'  FROM bordado bo
                                INNER JOIN pedidos pe ON pe.idpedido=bo.pedido
                                WHERE bo.estado<3 AND bo.finfecha>'$tresDias'";
                                $pedidos = $conexion->consultarDatos($consultaSQL);
                                $contar = $pedidos[0]['contar'];
                                $unds = $pedidos[0]['unds'];
                                $parcial = $pedidos[0]['parcial'];
                                $falta = $unds - $parcial;
                                //contar si confeccion y bodega tiene producto
                                $producto = 0;
                                $horas = 0;
                                $consultaSQL = "SELECT * FROM bordado WHERE estado<3 AND finfecha > '$tresDias'";
                                $pedidos = $conexion->consultarDatos($consultaSQL);
                                foreach ($pedidos as $pedido) {
                                    $idPedido = $pedido['pedido'];
                                    $consultaSQL = "SELECT * FROM bodega WHERE pedido=$idPedido AND entrega<>''";
                                    $prod_bodega = $conexion->consultarDatos($consultaSQL);
                                    if ($prod_bodega) {
                                        $producto++;
                                    }
                                    $consultaSQL = "SELECT * FROM confeccion WHERE pedido=$idPedido AND entrega<>''";
                                    $prod_confeccion = $conexion->consultarDatos($consultaSQL);
                                    if ($prod_confeccion) {
                                        $producto++;
                                    }
                                    //sumar tiempos
                                    $consultaSQL = "SELECT * FROM pedidos WHERE idpedido=$idPedido";
                                    $consulta = $conexion->consultarDatos($consultaSQL);
                                    $undsBordado = $consulta[0]['unds'];
                                    $falta = $undsBordado - $pedido['parcial'];
                                    $horas = $horas + round($falta * $pedido['punt_unidad'] / 66600, 2);
                                }
                                $turnos = round($horas / 8.25, 2);
                                ?>
                                <div class="card-header"><?php echo $contar . " pedidos.  (" . $producto . " con producto). <br> Unds Totales:" .
                                                                $unds . " (" . $parcial . " unds Listas). <br> Unds Faltantes: " . $falta . "<br> Horas Totales: " . $horas . "<br> Total Turnos: " . $turnos; ?>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-2" style="border:1px solid black"> TOTAL
                            <div class="card h-100 bg-dark text-white mb-1">
                                <?php
                                $consultaSQL = "SELECT count(bo.idbordado) as 'contar', sum(pe.unds) as 'unds', sum(bo.parcial) as 'parcial'  FROM bordado bo
                                INNER JOIN pedidos pe ON pe.idpedido=bo.pedido
                                WHERE bo.estado<3 ";
                                $pedidos = $conexion->consultarDatos($consultaSQL);
                                $contar = $pedidos[0]['contar'];
                                $unds = $pedidos[0]['unds'];
                                $parcial = $pedidos[0]['parcial'];
                                $falta = $unds - $parcial;
                                //contar si confeccion y bodega tiene producto
                                $producto = 0;
                                $horas = 0;
                                $consultaSQL = "SELECT * FROM bordado WHERE estado<3 ";
                                $pedidos = $conexion->consultarDatos($consultaSQL);
                                foreach ($pedidos as $pedido) {
                                    $idPedido = $pedido['pedido'];
                                    $consultaSQL = "SELECT * FROM bodega WHERE pedido=$idPedido AND entrega<>''";
                                    $prod_bodega = $conexion->consultarDatos($consultaSQL);
                                    if ($prod_bodega) {
                                        $producto++;
                                    }
                                    $consultaSQL = "SELECT * FROM confeccion WHERE pedido=$idPedido AND entrega<>''";
                                    $prod_confeccion = $conexion->consultarDatos($consultaSQL);
                                    if ($prod_confeccion) {
                                        $producto++;
                                    }
                                    //sumar tiempos
                                    $consultaSQL = "SELECT * FROM pedidos WHERE idpedido=$idPedido";
                                    $consulta = $conexion->consultarDatos($consultaSQL);
                                    $undsBordado = $consulta[0]['unds'];
                                    $falta = $undsBordado - $pedido['parcial'];
                                    $horas = $horas + round($falta * $pedido['punt_unidad'] / 66600, 2);
                                }
                                $turnos = round($horas / 8.25, 2);
                                ?>
                                <div class="card-header"><?php echo $contar . " pedidos.  (" . $producto . " con producto). <br> Unds Totales:" .
                                                                $unds . " (" . $parcial . " unds Listas). <br> Unds Faltantes: " . $falta . "<br> Horas Totales: " . $horas . "<br> Total Turnos: " . $turnos; ?>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <!-- acordeon de pedidos atrasados -->
                    <div class="collapse" id="pedidosAtrasados" data-parent="#accordionExample">
                        <div class="container">
                            <div class="row row-cols-1 row-cols-md-1">
                                <div class="col mb-4 ">
                                    <div class="card h-100 alert-danger">
                                        <div class="card-header text-center font-weight-bold p-0">
                                            <h1>Atrasados</h1>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-hover table-condensed table-bordered" style="border:1px solid black">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Pedido</th>
                                                        <th scope="col">Cliente</th>
                                                        <th scope="col">Procesos</th>
                                                        <th scope="col">Prod</th>
                                                        <th scope="col">Tot Punt</th>
                                                        <th scope="col">Tot Horas</th>
                                                        <th scope="col">Unds Total</th>
                                                        <th scope="col">Unds Parcial</th>
                                                        <th scope="col">Unds Falta</th>
                                                        <th scope="col">Fecha Entrega</th>
                                                        <th scope="col">Observaciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $undsTotal = 0;
                                                    $undsParcial = 0;
                                                    $undsFalta = 0;
                                                    $countPedido = 0;
                                                    $consultaSQL = "SELECT bo.pedido, pe.num_pedido, pe.cliente, pro.siglas, pe.unds, bo.parcial, bo.finfecha, bo.obs_bordado, bo.numNovedad, bo.punt_unidad FROM bordado bo
                                                    INNER JOIN pedidos pe ON bo.pedido=pe.idpedido
                                                    INNER JOIN procesos pro ON pe.procesos=pro.idproceso
                                                    
                                                    WHERE bo.finfecha<'$hoy' and bo.estado<3 order by bo.finfecha ASC";
                                                    $pedidos = $conexion->consultarDatos($consultaSQL);
                                                    foreach ($pedidos as $pedido) :
                                                        $numNovedad = $pedido['numNovedad'];
                                                        $consultaSQL = "SELECT * FROM novedades WHERE idNovedad='$numNovedad'";
                                                        $result = $conexion->consultarDatos($consultaSQL);
                                                        $novedad = @$result[0]['novedad'];
                                                        $undsTotal = $undsTotal + $pedido['unds'];
                                                        $undsParcial = $undsParcial + $pedido['parcial'];
                                                        $countPedido++;
                                                        //consultar el producto de bodega y confeccion
                                                        $idPedido = $pedido['pedido'];
                                                        $consultaSQL = "SELECT * FROM confeccion WHERE pedido='$idPedido'";
                                                        $result = $conexion->consultarDatos($consultaSQL);
                                                        $prodConfeccion = @$result[0]['entrega'];
                                                        $consultaSQL = "SELECT * FROM bodega WHERE pedido='$idPedido'";
                                                        $result = $conexion->consultarDatos($consultaSQL);
                                                        $prodBodega = @$result[0]['entrega'];
                                                        //tiempos
                                                        $falta = $pedido['unds'] - $pedido['parcial'];
                                                        $punt_unidad = $pedido['punt_unidad'];
                                                        $total_puntadas = $falta * $punt_unidad;
                                                        $horas_estimadas = round($total_puntadas / 66600, 2);
                                                    ?>

                                                        <tr style="border:1px solid black">
                                                            <th scope="row"><?php echo ($pedido['num_pedido']) ?></th>
                                                            <td class="text-uppercase"><?php echo ($pedido['cliente']) ?></td>
                                                            <td><?php echo ($pedido['siglas']) ?></td>
                                                            <td><?php echo ($prodConfeccion . $prodBodega); ?></td>
                                                            <td><?php echo ($total_puntadas); ?></td>
                                                            <td><?php echo ($horas_estimadas); ?></td>
                                                            <td><?php echo ($pedido['unds']) ?></td>
                                                            <td><?php echo ($pedido['parcial']) ?></td>
                                                            <td><?php echo ($pedido['unds'] - $pedido['parcial']) ?></td>
                                                            <td><?php echo ($pedido['finfecha']) ?></td>
                                                            <td><?php echo ($pedido['obs_bordado']);
                                                                if ($pedido['numNovedad'] > 0) {
                                                                    echo ("<br><b>Novedad:</b>" . $novedad);
                                                                } ?></td>

                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>

                                            </table>
                                        </div>
                                        <div class="card-footer text-uppercase font-weight-bold text-center">
                                            <span class="text-left"><?php echo ($countPedido) ?>
                                                Pedidos</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span class="text-right"><?php echo ($undsTotal) ?> Unds Totales</span>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span class="text-right"><?php echo ($undsParcial) ?> Unds Parcial</span>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span class="text-right"><?php echo ($undsTotal - $undsParcial) ?> Unds Falta</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- acordeon de pedidos 0 a 3 dias -->
                    <div class="collapse" id="pedidosTresDias" data-parent="#accordionExample">
                        <div class="container">
                            <div class="row row-cols-1 row-cols-md-1">
                                <div class="col mb-4 ">
                                    <div class="card h-100 alert-warning">


                                        <div class="card-header text-center font-weight-bold p-0">
                                            <h1>0 a 3 días</h1>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-hover table-condensed table-bordered" style="border:1px solid black">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Pedido</th>
                                                        <th scope="col">Cliente</th>
                                                        <th scope="col">Procesos</th>
                                                        <th scope="col">Prod</th>
                                                        <th scope="col">Tot Punt</th>
                                                        <th scope="col">Tot Horas</th>
                                                        <th scope="col">Unds Total</th>
                                                        <th scope="col">Unds Parcial</th>
                                                        <th scope="col">Unds Falta</th>
                                                        <th scope="col">Fecha Entrega</th>
                                                        <th scope="col">Observaciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $undsTotal = 0;
                                                    $undsParcial = 0;
                                                    $undsFalta = 0;
                                                    $countPedido = 0;
                                                    $consultaSQL = "SELECT bo.pedido, pe.num_pedido, pe.cliente, pro.siglas, pe.unds, bo.parcial, bo.finfecha, bo.obs_bordado, bo.numNovedad, bo.punt_unidad FROM bordado bo
                                                    INNER JOIN pedidos pe ON bo.pedido=pe.idpedido
                                                    INNER JOIN procesos pro ON pe.procesos=pro.idproceso
                                                    WHERE bo.finfecha BETWEEN '$hoy' AND '$tresDias' and bo.estado<3 order by bo.finfecha ASC";
                                                    $pedidos = $conexion->consultarDatos($consultaSQL);
                                                    foreach ($pedidos as $pedido) :
                                                        $numNovedad = $pedido['numNovedad'];
                                                        $consultaSQL = "SELECT * FROM novedades WHERE idNovedad='$numNovedad'";
                                                        $result = $conexion->consultarDatos($consultaSQL);
                                                        $novedad = @$result[0]['novedad'];
                                                        $undsTotal = $undsTotal + $pedido['unds'];
                                                        $undsParcial = $undsParcial + $pedido['parcial'];
                                                        $countPedido++;
                                                        //consultar el producto de bodega y confeccion
                                                        $idPedido = $pedido['pedido'];
                                                        $consultaSQL = "SELECT * FROM confeccion WHERE pedido='$idPedido'";
                                                        $result = $conexion->consultarDatos($consultaSQL);
                                                        $prodConfeccion = @$result[0]['entrega'];
                                                        $consultaSQL = "SELECT * FROM bodega WHERE pedido='$idPedido'";
                                                        $result = $conexion->consultarDatos($consultaSQL);
                                                        $prodBodega = @$result[0]['entrega'];
                                                        //tiempos
                                                        $falta = $pedido['unds'] - $pedido['parcial'];
                                                        $punt_unidad = $pedido['punt_unidad'];
                                                        $total_puntadas = $falta * $punt_unidad;
                                                        $horas_estimadas = round($total_puntadas / 66600, 2);
                                                    ?>

                                                        <tr style="border:1px solid black">
                                                            <th scope="row"><?php echo ($pedido['num_pedido']) ?></th>
                                                            <td class="text-uppercase"><?php echo ($pedido['cliente']) ?></td>
                                                            <td><?php echo ($pedido['siglas']) ?></td>
                                                            <td><?php echo ($prodConfeccion . $prodBodega); ?></td>
                                                            <td><?php echo ($total_puntadas); ?></td>
                                                            <td><?php echo ($horas_estimadas); ?></td>
                                                            <td><?php echo ($pedido['unds']) ?></td>
                                                            <td><?php echo ($pedido['parcial']) ?></td>
                                                            <td><?php echo ($pedido['unds'] - $pedido['parcial']) ?></td>
                                                            <td><?php echo ($pedido['finfecha']) ?></td>
                                                            <td><?php echo ($pedido['obs_bordado']);
                                                                if ($pedido['numNovedad'] > 0) {
                                                                    echo ("<br><b>Novedad:</b>" . $novedad);
                                                                } ?></td>

                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>

                                            </table>
                                        </div>
                                        <div class="card-footer text-uppercase font-weight-bold text-center">
                                            <span class="text-left"><?php echo ($countPedido) ?>
                                                Pedidos</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span class="text-right"><?php echo ($undsTotal) ?> Unds Totales</span>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span class="text-right"><?php echo ($undsParcial) ?> Unds Parcial</span>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span class="text-right"><?php echo ($undsTotal - $undsParcial) ?> Unds Falta</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- acordeon de pedidos 4 dias en adelante -->
                    <div class="collapse" id="pedidosCuatroDias" data-parent="#accordionExample">
                        <div class="container">
                            <div class="row row-cols-1 row-cols-md-1">
                                <div class="col mb-4 ">
                                    <div class="card h-100 alert-success">


                                        <div class="card-header text-center font-weight-bold p-0">
                                            <h1>4 días en Adelante</h1>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-hover table-condensed table-bordered" style="border:1px solid black">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Pedido</th>
                                                        <th scope="col">Cliente</th>
                                                        <th scope="col">Procesos</th>
                                                        <th scope="col">Prod</th>
                                                        <th scope="col">Tot Punt</th>
                                                        <th scope="col">Tot Horas</th>
                                                        <th scope="col">Unds Total</th>
                                                        <th scope="col">Unds Parcial</th>
                                                        <th scope="col">Unds Falta</th>
                                                        <th scope="col">Fecha Entrega</th>
                                                        <th scope="col">Observaciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $undsTotal = 0;
                                                    $undsParcial = 0;
                                                    $undsFalta = 0;
                                                    $countPedido = 0;
                                                    $consultaSQL = "SELECT bo.pedido, pe.num_pedido, pe.cliente, pro.siglas, pe.unds, bo.parcial, bo.finfecha, bo.obs_bordado, bo.numNovedad, bo.punt_unidad FROM bordado bo
                                                    INNER JOIN pedidos pe ON bo.pedido=pe.idpedido
                                                    INNER JOIN procesos pro ON pe.procesos=pro.idproceso
                                                    WHERE bo.finfecha >'$tresDias' and bo.estado<3 order by bo.finfecha ASC";
                                                    $pedidos = $conexion->consultarDatos($consultaSQL);
                                                    foreach ($pedidos as $pedido) :
                                                        $numNovedad = $pedido['numNovedad'];
                                                        $consultaSQL = "SELECT * FROM novedades WHERE idNovedad='$numNovedad'";
                                                        $result = $conexion->consultarDatos($consultaSQL);
                                                        $novedad = @$result[0]['novedad'];
                                                        $undsTotal = $undsTotal + $pedido['unds'];
                                                        $undsParcial = $undsParcial + $pedido['parcial'];
                                                        $countPedido++;
                                                        //consultar el producto de bodega y confeccion
                                                        $idPedido = $pedido['pedido'];
                                                        $consultaSQL = "SELECT * FROM confeccion WHERE pedido='$idPedido'";
                                                        $result = $conexion->consultarDatos($consultaSQL);
                                                        $prodConfeccion = @$result[0]['entrega'];
                                                        $consultaSQL = "SELECT * FROM bodega WHERE pedido='$idPedido'";
                                                        $result = $conexion->consultarDatos($consultaSQL);
                                                        $prodBodega = @$result[0]['entrega'];
                                                        //tiempos
                                                        $falta = $pedido['unds'] - $pedido['parcial'];
                                                        $punt_unidad = $pedido['punt_unidad'];
                                                        $total_puntadas = $falta * $punt_unidad;
                                                        $horas_estimadas = round($total_puntadas / 66600, 2);
                                                    ?>
                                                        <tr style="border:1px solid black">
                                                            <th scope="row"><?php echo ($pedido['num_pedido']) ?></th>
                                                            <td class="text-uppercase"><?php echo ($pedido['cliente']) ?></td>
                                                            <td><?php echo ($pedido['siglas']) ?></td>
                                                            <td><?php echo ($prodConfeccion . $prodBodega); ?></td>
                                                            <td><?php echo ($total_puntadas); ?></td>
                                                            <td><?php echo ($horas_estimadas); ?></td>
                                                            <td><?php echo ($pedido['unds']) ?></td>
                                                            <td><?php echo ($pedido['parcial']) ?></td>
                                                            <td><?php echo ($pedido['unds'] - $pedido['parcial']) ?></td>
                                                            <td><?php echo ($pedido['finfecha']) ?></td>
                                                            <td><?php echo ($pedido['obs_bordado']);
                                                                if ($pedido['numNovedad'] > 0) {
                                                                    echo ("<br><b>Novedad:</b>" . $novedad);
                                                                } ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>

                                            </table>
                                        </div>
                                        <div class="card-footer text-uppercase font-weight-bold text-center">
                                            <span class="text-left"><?php echo ($countPedido) ?>
                                                Pedidos</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span class="text-right"><?php echo ($undsTotal) ?> Unds Totales</span>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span class="text-right"><?php echo ($undsParcial) ?> Unds Parcial</span>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span class="text-right"><?php echo ($undsTotal - $undsParcial) ?> Unds Falta</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- acordeon de calendario -->
                    <div class="table-container collapse border rounded" id="calendarioPedidos" data-parent="#accordionExample">
                        <table class=" table table-bordered rounded tablaDinamica" style="border:1px solid black">
                            <?php
                            $numDia = (date('N')); //dias desde domingo 0

                            switch ($numDia) {
                                case 1:
                                    $r = 0;
                                    break;
                                case 2:
                                    $r = -1;
                                    break;
                                case 3:
                                    $r = -2;
                                    break;
                                case 4:
                                    $r = -3;
                                    break;
                                case 5:
                                    $r = -4;
                                    break;
                                case 6:
                                    $r = 0;
                                    break;
                                case 7:
                                    $r = -1;
                                    break;
                            }
                            $numSemana = (date('W')); //semana del año
                            $hoy = date('Y-m-d');
                            ?>
                            <thead>

                                <tr class=" text-center text-uppercase " style="border:1px solid black">
                                    <th class=" sticky-left sticky-top">
                                    </th>
                                    <th class="sticky-top ">
                                        <h1>Lunes</h1>
                                    </th>
                                    <th class="sticky-top ">
                                        <h1>Martes</h1>
                                    </th>
                                    <th class="sticky-top ">
                                        <h1>Miercoles</h1>
                                    </th>
                                    <th class="sticky-top ">
                                        <h1>Jueves</h1>
                                    </th>
                                    <th class="sticky-top ">
                                        <h1>Viernes</h1>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <div class="row row-cols-1 row-cols-md-5 ">
                                    <?php for ($i = 1; $i < 7; $i++) : ?>
                                        <tr style="border:1px solid black">
                                            <td class="mx-auto sticky-left">
                                                <h1>
                                                    <div class="texto-vertical-2 m-auto"><?php echo "Semana " . ($numSemana);
                                                                                            if ($numSemana == 52) {
                                                                                                $numSemana = 1;
                                                                                            } else {
                                                                                                $numSemana++;
                                                                                            }
                                                                                            ?></div>
                                                </h1>
                                            </td>
                                            <?php for ($u = 0; $u < 5; $u++) : ?>

                                                <td>
                                                    <div class="col mb-4 p-0">
                                                        <div class="card h-100  alert-<?php if ($r > 3) {
                                                                                            echo "success";
                                                                                        } else if ($r > 0) {
                                                                                            echo "warning";
                                                                                        } else if ($r == 0) {
                                                                                            echo "dark";
                                                                                        } else {
                                                                                            echo "danger";
                                                                                        } ?>">
                                                            <?php
                                                            $dia = dayToFecha($hoy, $r);
                                                            ?>
                                                            <div class="card-header text-center font-weight-bold" >
                                                                <?php if ($dia == $hoy) {
                                                                    echo ($dia) . " (HOY)";
                                                                } else {
                                                                    echo ($dia);
                                                                } ?></div>
                                                            <div class="card-body">
                                                                <table class="table table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">Pedido</th>
                                                                            <th scope="col">Cliente</th>
                                                                            <th scope="col">Procesos</th>
                                                                            <th scope="col">Prod</th>
                                                                            <th scope="col">Tot Punt</th>
                                                                            <th scope="col">Tot Horas</th>
                                                                            <th scope="col">Unds Total</th>
                                                                            <th scope="col">Unds Parcial</th>
                                                                            <th scope="col">Unds Falta</th>
                                                                            <th scope="col">Fecha Entrega</th>
                                                                            <th scope="col">Observaciones</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $undsTotal = 0;
                                                                        $undsParcial = 0;
                                                                        $undsFalta = 0;
                                                                        $countPedido = 0;
                                                                        $horas = 0;
                                                                        $consultaSQL = "SELECT pe.num_pedido, pe.cliente, pro.siglas, pe.unds, bo.parcial, bo.finfecha, bo.obs_bordado, bo.numNovedad, bo.pedido, bo.punt_unidad FROM bordado bo
                                                                                        INNER JOIN pedidos pe ON bo.pedido=pe.idpedido
                                                                                        INNER JOIN procesos pro ON pe.procesos=pro.idproceso
                                                                                        WHERE bo.finfecha ='$dia' and bo.estado<3 order by bo.finfecha ASC";
                                                                        $pedidos = $conexion->consultarDatos($consultaSQL);
                                                                        foreach ($pedidos as $pedido) :
                                                                            $numNovedad = $pedido['numNovedad'];
                                                                            $consultaSQL = "SELECT * FROM novedades WHERE idNovedad='$numNovedad'";
                                                                            $result = $conexion->consultarDatos($consultaSQL);
                                                                            $novedad = @$result[0]['novedad'];
                                                                            $undsTotal = $undsTotal + $pedido['unds'];
                                                                            $undsParcial = $undsParcial + $pedido['parcial'];
                                                                            $countPedido++;
                                                                            //consultar el producto de bodega y confeccion
                                                                            $idPedido = $pedido['pedido'];
                                                                            $consultaSQL = "SELECT * FROM confeccion WHERE pedido='$idPedido'";
                                                                            $result = $conexion->consultarDatos($consultaSQL);
                                                                            $prodConfeccion = @$result[0]['entrega'];
                                                                            $consultaSQL = "SELECT * FROM bodega WHERE pedido='$idPedido'";
                                                                            $result = $conexion->consultarDatos($consultaSQL);
                                                                            $prodBodega = @$result[0]['entrega'];
                                                                            //tiempos
                                                                            $falta = $pedido['unds'] - $pedido['parcial'];
                                                                            $punt_unidad = $pedido['punt_unidad'];
                                                                            $total_puntadas = $falta * $punt_unidad;
                                                                            $horas_estimadas = round($total_puntadas / 66600, 2);
                                                                            $horas = $horas + $horas_estimadas;
                                                                        ?>

                                                                            <tr>
                                                                                <th scope="row"><?php echo ($pedido['num_pedido']) ?></th>
                                                                                <td class="text-uppercase"><?php echo ($pedido['cliente']) ?></td>
                                                                                <td><?php echo ($pedido['siglas']) ?></td>
                                                                                <td><?php echo ($prodConfeccion . $prodBodega); ?></td>
                                                                                <td><?php echo ($total_puntadas); ?></td>
                                                                                <td><?php echo ($horas_estimadas); ?></td>
                                                                                <td><?php echo ($pedido['unds']) ?></td>
                                                                                <td><?php echo ($pedido['parcial']) ?></td>
                                                                                <td><?php echo ($pedido['unds'] - $pedido['parcial']) ?></td>
                                                                                <td><?php echo ($pedido['obs_bordado']);
                                                                                    if ($pedido['numNovedad'] > 0) {
                                                                                        echo ("<br><b>Novedad:</b>" . $novedad);
                                                                                    } ?></td>

                                                                            </tr>
                                                                        <?php endforeach;
                                                                        $turnos = round($horas / 8.25, 2); ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="card-footer text-uppercase font-weight-bold text-center">
                                                                <span class="text-left"><?php echo ($countPedido) ?>
                                                                    Pedidos</span>&nbsp;&nbsp;&nbsp;
                                                                <span class="text-right"><?php echo ($undsTotal) ?> Unds Totales</span>
                                                                &nbsp;&nbsp;&nbsp;
                                                                <span class="text-right"><?php echo ($undsParcial) ?> Unds Parcial</span>
                                                                &nbsp;&nbsp;&nbsp;
                                                                <span class="text-right"><?php echo ($undsTotal - $undsParcial) ?> Unds Falta</span>
                                                                &nbsp;&nbsp;&nbsp;
                                                                <span class="text-right"><?php echo ($horas) ?> Horas</span>
                                                                &nbsp;&nbsp;&nbsp;
                                                                <span class="text-right"><?php echo ($turnos) ?> Turnos</span>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </td>


                                            <?php $r++;
                                            endfor ?>
                                        </tr>

                                    <?php endfor; ?>
                                </div>
                            </tbody>

                        </table>
                    </div>
                </div>
        </main>

    </div>


</body>

</html>