<?php

session_start();

include("../db/Conexion.php");
include("php/funcionFecha.php");
if (empty($_SESSION['active'])) {
    header('location: ../');
} else {
    if (isset($_POST['botonRegistro'])) {
        $nroPedido = $_POST['nroPedido'];
        $nombreCliente = $_POST['nombreCliente'];
        $asesor = $_POST['asesor'];
        $fechaInicio = $_POST['fechaInicio'];
        $fechaFin = $_POST['fechaFin'];
        $unds = $_POST['unds'];
        $procesos = $_POST['procesos'];
        $idUsuario = $_SESSION['iduser'];
        $diasHabiles = $_POST['diasHabiles'];

        //ingresar datos a tabla pedidos
        $conexion = new Conexion();
        $consultaSQL = ("INSERT INTO pedidos(num_pedido,cliente, fecha_inicio, fecha_fin, dias_habiles, procesos, unds, asesor, usuario)
        values('$nroPedido','$nombreCliente','$fechaInicio','$fechaFin','$diasHabiles','$procesos','$unds', '$asesor', '$idUsuario')");
        $insert = $conexion->agregarDatos($consultaSQL);

        //veridicar si se ingresó datos a pedidos para ingresarlos a las áreas
        if ($insert == 1) {
            $alert = "<script> alertify.success('Pedido Ingresado'); </script>";
            //consultar id maximo de pedido
            $consultaSQL = "SELECT max(idpedido) as 'maxpedido' FROM pedidos";
            $result = $conexion->consultarDatos($consultaSQL);
            $maxPedido = $result[0]['maxpedido'];
            //consulta procesos implicados
            $consultaSQL = "SELECT * FROM procesos WHERE idproceso =$procesos";
            $result = $conexion->consultarDatos($consultaSQL);

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
        } else {
            $alert .= "<script> alertify.error('Error al registrar pedido'); </script>";
        }
    }
}
?>




<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>REGISTRO PEDIDO</title>
    <link rel="shortcut icon" href="images/icono.png" />
    <?php   include("includes/scriptUp.php");?>
  

</head>

<body class="sb-nav-fixed " >
    <?php include("includes/navBar.php") ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <ol class="breadcrumb mb-3 mt-3">
                    <li class="breadcrumb-item"><a class="a-text-kmisetas" href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Ingreso de Pedidos</li>
                </ol>
                <div class="container ">
                    <div class=" mx-auto d-block border border-dark rounded col-md-9 mb-4">
                        <h2 class="mx-auto d-block mt-2 p-1 text-center">Registro de Pedidos</h2>
                        <div><?php echo isset($alert) ? $alert : ''; ?></div>

                        <form action="" id="formIngresoPedido" class="needs-validation mt-4 p-2 " method="POST" novalidate>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <input type="text" class="form-control" id="nroPedido" name="nroPedido" placeholder="<?php if($_SESSION['idrol']==3){echo "Orden de Corte (*)";}else{echo "Nro Pedido (*)";} ?>" autocomplete="off" required autofocus>
                                    <div class="invalid-feedback">Ingrese el Nro de Pedido</div>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php
                                    $conexion = new Conexion();
                                    $consultaSQL = "SELECT * FROM clientes order by nombre asc";
                                    $clientes = $conexion->consultarDatos($consultaSQL);

                                    ?>

                                    <input list="nombreCliente" name="nombreCliente" class="form-control nombreCliente" placeholder="<?php if($_SESSION['idrol']==3){echo "Referencia (*)";}else{echo "Nombre Cliente (*)";} ?>" autocomplete="off" required></label>
                                    <datalist name="nombreCliente" id="nombreCliente">
                                        <?php foreach ($clientes as $cliente) : ?>
                                            <option value="<?php echo $cliente['nombre'] ?>"></option>
                                        <?php endforeach; ?>
                                    </datalist>

                                    <div class="invalid-feedback">Ingrese el Nombre del Cliente.</div>
                                </div>
                                <div class="form-group col-md-3">
                                    <?php

                                    $consultaAsesor = "SELECT * FROM asesor order by usuario asc";
                                    $asesores = $conexion->consultarDatos($consultaAsesor);

                                    ?>

                                    <input list="asesor" name="asesor" id="" class="form-control asesor" placeholder="<?php if($_SESSION['idrol']==3){echo "Cliente (*)";}else{echo "Asesor (*)";} ?>" autocomplete="off" required></label>
                                    <datalist name="asesor" id="asesor">
                                        <?php foreach ($asesores as $asesor) : ?>
                                            <option value="<?php echo $asesor['usuario'] ?>"></option>
                                        <?php endforeach; ?>
                                    </datalist>
                                    <!-- <div class="valid-feedback">Listo</div> -->
                                    <div class="invalid-feedback">Ingrese el Asesor.</div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label for="fechaInicio">Fecha Inicio: (*)</label>
                                    <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" required>
                                    <!-- <div class="valid-feedback">Listo</div> -->
                                    <div class="invalid-feedback">Ingrese Fecha</div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="fechaFin">Fecha Final: (*)</label>
                                    <input type="date" class="form-control" id="fechaFin" name="fechaFin" required>
                                    <!-- <div class="valid-feedback">Listo</div> -->
                                    <div class="invalid-feedback">Ingrese Fecha</div>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="diasHabiles">Días Hábiles</label>
                                    <input class="form-control" type="text" name="diasHabiles" id="diasHabiles" readonly>

                                </div>
                            </div>

                            <div class="form-row justify-content-center text-center">

                                <div class="form-group col-md-3">
                                    <label for="unds">Unds: (*)</label>
                                    <input type="number" class="form-control " id="unds" placeholder="" name="unds" required>
                                    <!-- <div class="valid-feedback">Listo</div> -->
                                    <div class="invalid-feedback">Ingrese Unidades</div>
                                </div>

                                <div class="form-group col-md-3">
                                    <?php
                                    $consultaProcesos = "SELECT * FROM procesos ";
                                    $procesos = $conexion->consultarDatos($consultaProcesos);
                                    ?>
                                    <label for="procesos">Procesos (*)</label>
                                    <select class="form-control " name="procesos" id="procesos" required>
                                        <option value="" selected disabled>Ingrese Proceso</option>
                                        <?php foreach ($procesos as $proceso) : ?>
                                            <option value="<?php echo ($proceso['idproceso']) ?>"><?php echo ($proceso['siglas']) ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                    <!-- <div class="valid-feedback">Listo</div> -->
                                    <div class="invalid-feedback">Ingrese Los Procesos</div>
                                </div>
                            </div>
                            <div id="diasProceso" class=""></div>
                            <button type="submit" class="btn btn-dark mb-5 mt-3 d-block mx-auto" name="botonRegistro" id="botonRegistro">Registrar Pedido</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <?php include("includes/footer.php") ?>
    </div>
    </div>
    <?php include("includes/scriptDown.php") ?>
    <!-- jquery para cargar dias -->
    <script>
        $(document).ready(function() {

            $('#fechaFin').change(function() {
                $.ajax({
                    type: "POST",
                    url: "php/cargarDias.php",
                    data: $('#formIngresoPedido').serialize(),
                    success: function(r) {
                        $('#diasHabiles').val(r);
                        $('#diasProceso').empty();
                        $('#procesos').val('');

                    }
                });
            });

            $('#fechaInicio').change(function() {
                $('#fechaFin').val('');
                $('#procesos').val('');
                $('#diasHabiles').empty();
                $('#diasProceso').empty();
            });

            $('#procesos').change(function() {
                $.ajax({
                    type: "POST",
                    url: "php/cargarProcesos.php",
                    data: $('#formIngresoPedido').serialize(),
                    success: function(r) {
                        $('#diasProceso').html(r);
                    }
                });
            });
            $('.nombreCliente').change(function() {
                $.ajax({
                    type: "POST",
                    url: "php/cargarAsesor.php",
                    data: $('#formIngresoPedido').serialize(),
                    success: function(r) {
                        $('.asesor').val(r);
                    }
                });

            });

        });
    </script>
    <!-- Cargar procesos -->


</body>

</html>