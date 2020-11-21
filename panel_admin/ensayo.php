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
                
                <?php echo date("W")?>
  
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