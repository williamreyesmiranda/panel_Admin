<!DOCTYPE html>
<html lang="es">

<?php
session_set_cookie_params(60 * 60 * 24);
session_start();
include("../db/Conexion.php");
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
    <title>STOCK MÍNIMO</title>
    <link rel="shortcut icon" href="images/icono.png" />
    <?php include("includes/scriptUp.php") ?>
</head>


<body class="sb-nav-fixed ">
    <?php include("includes/navBar.php") ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <ol class="breadcrumb mb-3 mt-3 ">
                    <li class="breadcrumb-item "><a class="a-text-kmisetas" href="index.php">Inicio</a></li>
                    <li class="breadcrumb-item active">Stock Mínimo</li>
                </ol>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="tablaStockMinimo"></div>

                    </div>
                </div>
                <!-- tabla -->

            </div>
            <!-- MODALES -->
            <!-- modal ingresar Colores -->
            <div div class="modal fade" id="relacionarColor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h2 class="modal-title mx-auto">Relacionar Colores con Referencia</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="salirModal" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body ">
                            <div class=" mx-auto d-block border border-dark rounded col-md-12">
                                <form id="formRelacionarColores" class="needs-validation p-2 " method="POST" novalidate>
                                    <div class="cargaRelacion">
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-dismiss="modal" id="" onclick="relacionarColor()">Relacionar</button>
                            <button type="button" class="btn btn-danger salirModal" data-dismiss="modal" id="salirModal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
            
        </main>
        <?php include("includes/footer.php") ?>
    </div>

    <?php include("includes/scriptDown.php") ?>

    <script>
        $(document).ready(function() {
            $('.tablaStockMinimo').load('tablas/tablaStockMinimo.php');
            /*Swal.fire({
                position: 'center',
                html: '<br><img src="images/logo_kamisetas.png" alt="" style="width:150px">',
                title: '<br>Página en construcción',
                background: ' #000000cd',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                backdrop: false,
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });*/

            $(".select2").select2({
                width: 200,
            });
        });
    </script>

</body>

</html>