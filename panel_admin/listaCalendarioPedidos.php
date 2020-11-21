<!DOCTYPE html>
<html lang="es">

<?php
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


<body class="sb-nav-fixed ">
    <?php include("includes/navBar.php") ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <ol class="breadcrumb mb-3 mt-3">
                    <li class="breadcrumb-item "><a class="a-text-kmisetas" href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Calendario Pedidos</li>
                </ol>

                <div class="row row-cols-1 row-cols-md-1 ">
                    <div class="col mb-4 ">
                        <div class="card h-100 alert-danger">

                            <?php
                            $hoy = date('d-m-Y');
                            $dia = dayToFecha($hoy, 0);
                            ?>
                            <div class="card-header text-center font-weight-bold">Atrasados</div>
                            <div class="card-body">
                                <table class="table table-hover table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Pedido</th>
                                            <th scope="col">Cliente</th>
                                            <th scope="col">Unds</th>
                                            <th scope="col">Fecha Entrega</th>
                                            <th scope="col">Procesos</th>
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
                                        WHERE pe.fecha_fin<'$dia' and pe.estado<3 order by pe.fecha_fin ASC";
                                        $pedidos = $conexion->consultarDatos($consultaSQL);
                                        foreach ($pedidos as $pedido) :
                                            $totalUnds = $totalUnds + $pedido['unds'];
                                            $countPedido++;
                                        ?>

                                            <tr>
                                                <th scope="row"><?php echo ($pedido['num_pedido']) ?></th>
                                                <td class="text-uppercase"><?php echo ($pedido['cliente']) ?></td>
                                                <td><?php echo ($pedido['unds']) ?></td>
                                                <td><?php echo ($pedido['fecha_fin']) ?></td>
                                                <td><?php echo ($pedido['siglas']) ?></td>
                                                <td><?php echo ($pedido['estado']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfooter>
                                        <tr>
                                            <th class="text-right"><?php echo ($countPedido) ?></th>
                                            <th>Pedidos</th>
                                            <th><?php echo ($totalUnds) ?></th>
                                            <td></td>

                                        </tr>
                                    </tfooter>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <div style="width: 150% !important;">
                    <div class="row row-cols-1 row-cols-md-5 ">
                        <!-- 0 a 3 dias -->
                        <?php for ($i = 0; $i < 30; $i++) : ?>
                            <div class="col mb-4 ">
                                <div class="card h-100 alert-<?php if ($i > 3) {
                                                                    echo "success";
                                                                } else {
                                                                    echo "warning";
                                                                } ?>">

                                    <?php
                                    $dia = dayToFecha($hoy, $i);
                                    ?>
                                    <div class="card-header text-center font-weight-bold"><?php echo ($dia) ?></div>
                                    <div class="card-body">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Pedido</th>
                                                    <th scope="col">Cliente</th>
                                                    <th scope="col">Unds</th>
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
                                                        <th scope="row"><?php echo ($pedido['num_pedido']) ?></th>
                                                        <td class="text-uppercase"><?php echo ($pedido['cliente']) ?></td>
                                                        <td><?php echo ($pedido['unds']) ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                            <tfooter>
                                                <tr>
                                                    <th class="text-right"><?php echo ($countPedido) ?></th>
                                                    <th>Pedidos</th>
                                                    <th><?php echo ($totalUnds) ?></th>
                                                    <td></td>

                                                </tr>
                                            </tfooter>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        <?php endfor ?>

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
            $('#mostrarTabla').load('tablas/tablaPedido.php');

            //cargar dias habiles en editar pedido
            $('.finEditar').change(function() {
                //llamar dias habiles
                $.ajax({
                    type: "POST",
                    url: "php/cargarDias.php",
                    data: $('#formEditarPedido').serialize(),
                    success: function(data) {
                        $('.diasEditar').val(data);
                    }
                });
                //llamar dias de procesos
                $.ajax({
                    type: "POST",
                    url: "php/cargarProcesos.php",
                    data: $('#formEditarPedido').serialize(),
                    success: function(data) {
                        $('.diasProcesoEditar').html(data);
                    }
                });
            });
            $('.procesosCargar').change(function() {

                $.ajax({
                    type: "POST",
                    url: "php/cargarProcesos.php",
                    data: $('#formEditarPedido').serialize(),
                    success: function(data) {
                        $('.diasProcesoEditar').html(data);
                    }
                });

            });
            //borrar los datos cuando se ingresa nueva fecha en inicioFecha
            $('.inicioEditar').change(function() {
                $('.finEditar').val(''),
                    $('.diasEditar').val('');
                $('.diasProcesoEditar').html('');
            });

        });
    </script>

</body>

</html>