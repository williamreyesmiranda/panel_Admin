<!DOCTYPE html>
<html lang="es">

<?php
session_set_cookie_params(60 * 60 * 24);
session_start();
include("../db/Conexion.php");
include("php/funcionFecha.php");
date_default_timezone_set('America/Bogota');

if (empty($_SESSION['active'])) {
    header('location: ../');
}
?>



<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>INICIO</title>
    <link rel="shortcut icon" href="images/icono.png" />
    <?php include("includes/scriptUp.php") ?>
</head>
<style>

</style>

<body class="sb-nav-fixed ">
    <?php include("includes/navBar.php") ?>
    <div id="layoutSidenav_content" style="background-color: #ededed">
        <main>
            <div class="container-fluid">
                <ol class="breadcrumb mt-3" style="background-color: #FFFFFF;">

                    <li class="breadcrumb-item active">Inicio</li>
                </ol>
                <?php
                $hoy = date('Y-m-d');
                $tresDias = dayToFecha($hoy, 3);
                ?>
                <div class="accordion" id="accordionExample">
                    <!-- botones para acordeon -->
                    <div class="alert" style="background-color: #FFFFFF;"" >
                        <h4 class=" text-rigth" style="font-weight: 500;"><i class="fas fa-clipboard-list"></i> Informe General de Pedidos </h4>
                        <hr>
                        <div class="breadcrumb px-0 h-100" style="background-color: #FFFFFF;">

                            <div class="col-xl-3 col-md-6 mb-2">
                                <a data-toggle="collapse" href="#pedidosAtrasados" role="button" aria-expanded="false" aria-controls="pedidosAtrasados" style="text-decoration:none; color:black; text-align:center;">
                                    <div class="card h-100 mb-1 ">
                                        <?php
                                        $conexion = new Conexion();
                                        $consultaSQL = "SELECT count(unds) as 'contar', sum(unds) as 'unds'  FROM pedidos 
                                WHERE estado<3 AND fecha_fin < '$hoy'";
                                        $pedidos = $conexion->consultarDatos($consultaSQL);
                                        $contar = $pedidos[0]['contar'];
                                        $unds = $pedidos[0]['unds'];
                                        ?>
                                        <div class="row ">
                                            <div class="col-md-4 " style="font-size: 60px; color:#c00808">
                                                <i class="fas fa-bell "></i>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="text-center" style="font-size: 18px; color:black; font-weight:500; margin-top:3px">Atrasados</div>
                                                <hr style="padding: 0; margin:0px; color: #000000;font-size: 10px;">
                                                <?php echo $contar . "  (" . $unds . " unds)."; ?>
                                                <div style="margin-top:8px; margin-bottom:8px;">
                                                    <span style="background-color: #c00808; color:#FFFFFF; padding:5px; border-radius:50px; "> Ver Detalle <i class="fas fa-angle-right"></i></span>
                                                </div>
                                            </div>


                                        </div>


                                    </div>
                                </a>

                            </div>
                            <div class="col-xl-3 col-md-6 mb-2">
                                <a data-toggle="collapse" href="#pedidosTresDias" role="button" aria-expanded="false" aria-controls="pedidosTresDias" style="text-decoration:none; color:black; text-align:center;">
                                    <div class="card h-100 mb-1 ">
                                        <?php
                                        $conexion = new Conexion();
                                        $consultaSQL = "SELECT count(unds) as 'contar', sum(unds) as 'unds'  FROM pedidos 
                                WHERE estado<3 AND fecha_fin BETWEEN '$hoy' AND '$tresDias'";
                                        $pedidos = $conexion->consultarDatos($consultaSQL);
                                        $contar = $pedidos[0]['contar'];
                                        $unds = $pedidos[0]['unds'];
                                        ?>
                                        <div class="row ">
                                            <div class="col-md-4 " style="font-size: 60px; color:#f1cd00">
                                                <i class="fas fa-bell "></i>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="text-center" style="font-size: 18px; color:black; font-weight:500; margin-top:3px">0 a 3 días</div>
                                                <hr style="padding: 0; margin:0px; color: #000000;font-size: 10px;">
                                                <?php echo $contar . " (" . $unds . " unds)."; ?>
                                                <div style="margin-top:8px; margin-bottom:8px;">
                                                    <span style="background-color: #f1cd00; color:#FFFFFF; padding:5px; border-radius:50px; "> Ver Detalle <i class="fas fa-angle-right"></i></span>
                                                </div>
                                            </div>


                                        </div>


                                    </div>
                                </a>

                            </div>
                            <div class="col-xl-3 col-md-6 mb-2">
                                <a data-toggle="collapse" href="#pedidosCuatroDias" role="button" aria-expanded="false" aria-controls="pedidosCuatroDias" style="text-decoration:none; color:black; text-align:center;">
                                    <div class="card h-100 mb-1 ">
                                        <?php
                                        $conexion = new Conexion();
                                        $consultaSQL = "SELECT count(unds) as 'contar', sum(unds) as 'unds'  FROM pedidos 
                                        WHERE estado<3 AND fecha_fin > '$tresDias'";
                                        $pedidos = $conexion->consultarDatos($consultaSQL);
                                        $contar = $pedidos[0]['contar'];
                                        $unds = $pedidos[0]['unds'];
                                        ?>
                                        <div class="row ">
                                            <div class="col-md-4 " style="font-size: 60px; color: #20a14b">
                                                <i class="fas fa-bell "></i>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="text-center" style="font-size: 18px; color:black; font-weight:500; margin-top:3px">> 3 días</div>
                                                <hr style="padding: 0; margin:0px; color: #000000;font-size: 10px;">
                                                <?php echo $contar . "  (" . $unds . " unds)."; ?>
                                                <div style="margin-top:8px; margin-bottom:8px;">
                                                    <span style="background-color:  #20a14b; color:#FFFFFF; padding:5px; border-radius:50px; "> Ver Detalle <i class="fas fa-angle-right"></i></span>
                                                </div>
                                            </div>


                                        </div>


                                    </div>
                                </a>

                            </div>
                            <div class="col-xl-3 col-md-6 mb-2">
                                <a data-toggle="collapse" href="#calendarioPedidos" role="button" aria-expanded="false" aria-controls="calendarioPedidos" style="text-decoration:none; color:black; text-align:center;">
                                    <div class="card h-100 mb-1 ">
                                        <?php
                                        $conexion = new Conexion();
                                        $consultaSQL = "SELECT count(unds) as 'contar', sum(unds) as 'unds'  FROM pedidos 
                                        WHERE estado<3";
                                        $pedidos = $conexion->consultarDatos($consultaSQL);
                                        $contar = $pedidos[0]['contar'];
                                        $unds = $pedidos[0]['unds'];
                                        ?>
                                        <div class="row ">
                                            <div class="col-md-4 text-dark" style="font-size: 60px">
                                                <i class="fas fa-bell "></i>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="text-center" style="font-size: 18px; color:black; font-weight:500; margin-top:3px">Total</div>
                                                <hr style="padding: 0; margin:0px; color: #000000;font-size: 10px;">
                                                <?php echo $contar . " (" . $unds . " unds)."; ?>
                                                <div  style="margin-top:8px; margin-bottom:8px;">
                                                    <span class="bg-dark" style="color:#FFFFFF; padding:5px; border-radius:50px; "> Ver Calendario <i class="fas fa-angle-right"></i></span>
                                                </div>
                                            </div>


                                        </div>


                                    </div>
                                </a>

                            </div>
                        </div>
                    </div>
                    <!-- acordeon de pedidos atrasados -->
                    <div class="collapse" id="pedidosAtrasados" data-parent="#accordionExample">
                        <div class="container">
                            <div class="row row-cols-1 row-cols-md-1">
                                <div class="col mb-4 ">
                                    <div class="card h-100 alert-danger">

                                        <?php
                                        $hoy = date('Y-m-d');
                                        ?>
                                        <div class="card-header text-center font-weight-bold p-0">
                                            <h1>Atrasados</h1>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-hover table-condensed table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Pedido</th>
                                                        <th scope="col">Cliente</th>
                                                        <th scope="col">Unds</th>
                                                        <th scope="col">Fecha Entrega</th>
                                                        <th scope="col">Procesos</th>
                                                        <th scope="col">B</th>
                                                        <th scope="col">Ct</th>
                                                        <th scope="col">Cf</th>
                                                        <th scope="col">S</th>
                                                        <th scope="col">E</th>
                                                        <th scope="col">V</th>
                                                        <th scope="col">Estado</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    $conexion = new Conexion();
                                                    $totalUnds = 0;
                                                    $countPedido = 0;
                                                    $consultaSQL = "SELECT * FROM pedidos pe
                                        INNER JOIN procesos pr ON pe.procesos=pr.idproceso
                                        INNER JOIN estado est ON est.id_estado=pe.estado
                                        INNER JOIN usuario us ON us.idusuario=pe.usuario
                                        WHERE pe.fecha_fin<'$hoy' and pe.estado<3 order by pe.fecha_fin ASC";
                                                    $pedidos = $conexion->consultarDatos($consultaSQL);
                                                    foreach ($pedidos as $pedido) :
                                                        $totalUnds = $totalUnds + $pedido['unds'];
                                                        $countPedido++;
                                                    ?>

                                                        <tr>
                                                            <th scope="row"><?php echo ($pedido['num_pedido']) ?></th>
                                                            <td class="text-uppercase"><?php echo ($pedido['cliente']) ?>
                                                            </td>
                                                            <td><?php echo ($pedido['unds']) ?></td>
                                                            <td><?php echo ($pedido['fecha_fin']) ?></td>
                                                            <td><?php echo ($pedido['siglas']) ?></td>
                                                            <td><?php echo ($pedido['estBodega']) ?></td>
                                                            <td><?php echo ($pedido['estCorte']) ?></td>
                                                            <td><?php echo ($pedido['estConfeccion']) ?></td>
                                                            <td><?php echo ($pedido['estSublimacion']) ?></td>
                                                            <td><?php echo ($pedido['estEstampacion']) ?></td>
                                                            <td><?php echo ($pedido['estBordado']) ?></td>
                                                            <td><?php echo ($pedido['estado']) ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>

                                            </table>
                                        </div>
                                        <div class="card-footer text-uppercase font-weight-bold text-center">
                                            <span class="text-left"><?php echo ($countPedido) ?>
                                                Pedidos</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span class="text-right"><?php echo ($totalUnds) ?> Unds</span>
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

                                        <?php
                                        $hoy = date('Y-m-d');
                                        $tresDias = dayToFecha($hoy, 3);
                                        ?>
                                        <div class="card-header text-center font-weight-bold p-0">
                                            <h1>0 a 3 días</h1>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-hover table-condensed table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Pedido</th>
                                                        <th scope="col">Cliente</th>
                                                        <th scope="col">Unds</th>
                                                        <th scope="col">Fecha Entrega</th>
                                                        <th scope="col">Procesos</th>
                                                        <th scope="col">B</th>
                                                        <th scope="col">Ct</th>
                                                        <th scope="col">Cf</th>
                                                        <th scope="col">S</th>
                                                        <th scope="col">E</th>
                                                        <th scope="col">V</th>
                                                        <th scope="col">Estado</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    $conexion = new Conexion();
                                                    $totalUnds = 0;
                                                    $countPedido = 0;
                                                    $consultaSQL = "SELECT * FROM pedidos pe
                                        INNER JOIN procesos pr ON pe.procesos=pr.idproceso
                                        INNER JOIN estado est ON est.id_estado=pe.estado
                                        INNER JOIN usuario us ON us.idusuario=pe.usuario
                                        WHERE pe.estado<3 AND pe.fecha_fin BETWEEN '$hoy' AND '$tresDias'order by pe.fecha_fin ASC";
                                                    $pedidos = $conexion->consultarDatos($consultaSQL);
                                                    foreach ($pedidos as $pedido) :
                                                        $totalUnds = $totalUnds + $pedido['unds'];
                                                        $countPedido++;
                                                    ?>

                                                        <tr>
                                                            <th scope="row"><?php echo ($pedido['num_pedido']) ?></th>
                                                            <td class="text-uppercase"><?php echo ($pedido['cliente']) ?>
                                                            </td>
                                                            <td><?php echo ($pedido['unds']) ?></td>
                                                            <td><?php echo ($pedido['fecha_fin']) ?></td>
                                                            <td><?php echo ($pedido['siglas']) ?></td>
                                                            <td><?php echo ($pedido['estBodega']) ?></td>
                                                            <td><?php echo ($pedido['estCorte']) ?></td>
                                                            <td><?php echo ($pedido['estConfeccion']) ?></td>
                                                            <td><?php echo ($pedido['estSublimacion']) ?></td>
                                                            <td><?php echo ($pedido['estEstampacion']) ?></td>
                                                            <td><?php echo ($pedido['estBordado']) ?></td>
                                                            <td><?php echo ($pedido['estado']) ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>

                                            </table>
                                        </div>
                                        <div class="card-footer text-uppercase font-weight-bold text-center">
                                            <span class="text-left"><?php echo ($countPedido) ?>
                                                Pedidos</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span class="text-right"><?php echo ($totalUnds) ?> Unds</span>
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

                                        <?php
                                        $hoy = date('Y-m-d');
                                        $tresDias = dayToFecha($hoy, 3);
                                        ?>
                                        <div class="card-header text-center font-weight-bold p-0">
                                            <h1>4 días en Adelante</h1>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-hover table-condensed table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Pedido</th>
                                                        <th scope="col">Cliente</th>
                                                        <th scope="col">Unds</th>
                                                        <th scope="col">Fecha Entrega</th>
                                                        <th scope="col">Procesos</th>
                                                        <th scope="col">B</th>
                                                        <th scope="col">Ct</th>
                                                        <th scope="col">Cf</th>
                                                        <th scope="col">S</th>
                                                        <th scope="col">E</th>
                                                        <th scope="col">V</th>
                                                        <th scope="col">Estado</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    $conexion = new Conexion();
                                                    $totalUnds = 0;
                                                    $countPedido = 0;
                                                    $consultaSQL = "SELECT * FROM pedidos pe
                                        INNER JOIN procesos pr ON pe.procesos=pr.idproceso
                                        INNER JOIN estado est ON est.id_estado=pe.estado
                                        INNER JOIN usuario us ON us.idusuario=pe.usuario
                                        WHERE pe.estado<3 AND pe.fecha_fin > '$tresDias'order by pe.fecha_fin ASC";
                                                    $pedidos = $conexion->consultarDatos($consultaSQL);
                                                    foreach ($pedidos as $pedido) :
                                                        $totalUnds = $totalUnds + $pedido['unds'];
                                                        $countPedido++;
                                                    ?>

                                                        <tr>
                                                            <th scope="row"><?php echo ($pedido['num_pedido']) ?></th>
                                                            <td class="text-uppercase"><?php echo ($pedido['cliente']) ?>
                                                            </td>
                                                            <td><?php echo ($pedido['unds']) ?></td>
                                                            <td><?php echo ($pedido['fecha_fin']) ?></td>
                                                            <td><?php echo ($pedido['siglas']) ?></td>
                                                            <td><?php echo ($pedido['estBodega']) ?></td>
                                                            <td><?php echo ($pedido['estCorte']) ?></td>
                                                            <td><?php echo ($pedido['estConfeccion']) ?></td>
                                                            <td><?php echo ($pedido['estSublimacion']) ?></td>
                                                            <td><?php echo ($pedido['estEstampacion']) ?></td>
                                                            <td><?php echo ($pedido['estBordado']) ?></td>
                                                            <td><?php echo ($pedido['estado']) ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>

                                            </table>
                                        </div>
                                        <div class="card-footer text-uppercase font-weight-bold text-center">
                                            <span class="text-left"><?php echo ($countPedido) ?>
                                                Pedidos</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span class="text-right"><?php echo ($totalUnds) ?> Unds</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- acordeon de calendario -->
                    <div class="table-container collapse border rounded" id="calendarioPedidos" data-parent="#accordionExample">
                        <table class="table table-bordered rounded tablaDinamica">
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

                                <tr class=" text-center text-uppercase ">
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
                                        <tr>
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
                                                            <div class="card-header text-center font-weight-bold">
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
                                                                            <th scope="col">Unds</th>
                                                                            <th>Pro</th>
                                                                            <th scope="col">B</th>
                                                                            <th scope="col">Ct</th>
                                                                            <th scope="col">Cf</th>
                                                                            <th scope="col">S</th>
                                                                            <th scope="col">E</th>
                                                                            <th scope="col">V</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php

                                                                        $conexion = new Conexion();
                                                                        $totalUnds = 0;
                                                                        $countPedido = 0;
                                                                        $consultaSQL = "SELECT * FROM pedidos pe INNER JOIN 
                                            procesos pro ON pro.idproceso=pe.procesos WHERE fecha_fin='$dia' AND estado<3 AND estado<3";
                                                                        $pedidos = $conexion->consultarDatos($consultaSQL);
                                                                        foreach ($pedidos as $pedido) :
                                                                            $totalUnds = $totalUnds + $pedido['unds'];
                                                                            $countPedido++;
                                                                        ?>

                                                                            <tr>
                                                                                <th scope="row">
                                                                                    <?php echo ($pedido['num_pedido']) ?></th>
                                                                                <td class="text-uppercase">
                                                                                    <?php echo ($pedido['cliente']) ?></td>
                                                                                <td><?php echo ($pedido['unds']) ?></td>
                                                                                <td><?php echo ($pedido['siglas']) ?></td>
                                                                                <td><?php echo ($pedido['estBodega']) ?></td>
                                                                                <td><?php echo ($pedido['estCorte']) ?></td>
                                                                                <td><?php echo ($pedido['estConfeccion']) ?></td>
                                                                                <td><?php echo ($pedido['estSublimacion']) ?></td>
                                                                                <td><?php echo ($pedido['estEstampacion']) ?></td>
                                                                                <td><?php echo ($pedido['estBordado']) ?></td>
                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="card-footer text-uppercase font-weight-bold text-center">

                                                                <span class="text-left"><?php echo ($countPedido) ?>
                                                                    Pedidos</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <span class="text-right"><?php echo ($totalUnds) ?> Unds</span>
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
                <!-- Novedades -->
                <div class="card mb-4 ">
                    <div class="card-header  alert-secondary" style="background-color: #FFFFFF;">
                        <h1 class="text-center">Novedades de Áreas</h1>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-condensed table-bordered tablaNovedad rounded" id="" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="text-center">
                                        <th>ID</th>
                                        <th>Nr° Pedido</th>
                                        <th>Cliente</th>
                                        <th>Asesor</th>
                                        <th>Área</th>
                                        <th>Novedad</th>
                                        <th>Estado</th>
                                        <th>Generado Por:</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="text-center">
                                        <th>ID</th>
                                        <th>Nr° Pedido</th>
                                        <th>Cliente</th>
                                        <th>Asesor</th>
                                        <th>Área</th>
                                        <th>Novedad</th>
                                        <th>Estado</th>
                                        <th>Generado Por:</th>
                                    </tr>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $conexion = new Conexion();
                                    $consultaSQL = "SELECT * FROM novedades nov
                                                    INNER JOIN pedidos pe ON nov.idPedido=pe.idpedido
                                                    INNER JOIN usuario usu ON usu.idusuario=nov.usuario order by idNovedad desc";
                                    $novedades = $conexion->consultarDatos($consultaSQL);
                                    foreach ($novedades as $novedad) :
                                    ?>
                                        <tr class="text-center">
                                            <td><?php echo ($novedad['idNovedad']); ?></td>
                                            <td><?php echo ($novedad['num_pedido']); ?></td>
                                            <td><?php echo ($novedad['cliente']); ?></td>
                                            <td><?php echo ($novedad['asesor']); ?></td>
                                            <td><?php echo ($novedad['area']); ?></td>
                                            <td><?php echo ($novedad['novedad']); ?></td>
                                            <?php if ($novedad['estadoNovedad'] == 1) {
                                                echo "<td class='alert-dark'>Activo</td>";
                                            } else {
                                                echo "<td class='alert-success'>Finalizado</td>";
                                            }; ?>
                                            <td><?php echo ($novedad['nombre']); ?></td>
                                        </tr>

                                    <?php

                                    endforeach;  ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </main>
        <?php include("includes/footer.php") ?>
    </div>

    <?php include("includes/scriptDown.php") ?>

    <!-- alerta al cancelar modal -->
    <script>
        $(document).ready(function() {
            $('.tablaDinamica').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL'
                    },
                    'print'
                ],
                responsive: true,
                "order": [
                    [1, "asc"]
                ],
                "pageLength": 25,
                "language": {
                    "url": "plugins/datatable/Spanish.json"
                },
            });
            $('.tablaNovedad').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        /*  pageSize: 'LEGAL' */
                    },
                    'print'
                ],
                responsive: true,
                "order": [
                    [6, "asc"]
                ],
                "pageLength": 10,
                "language": {
                    "url": "plugins/datatable/Spanish.json"
                },
            });
        });
    </script>
</body>

</html>