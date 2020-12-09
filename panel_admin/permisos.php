<!DOCTYPE html>
<html lang="es">

<?php
session_start([
    'cookie_lifetime' => 86400,
]);
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
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <ol class="breadcrumb mb-3 mt-3">
                    <li class="breadcrumb-item "><a class="a-text-kmisetas" href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Permisos</li>
                </ol>

 

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

        });
    </script>

</body>

</html>