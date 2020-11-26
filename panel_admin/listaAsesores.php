<!DOCTYPE html>
<html lang="es">

<?php
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
    <title>LISTA ASESORES</title>
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
                    <li class="breadcrumb-item active">Lista Asesores</li>
                </ol>

                <!-- tabla -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i> Lista Asesores
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="mostrarTabla"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODALES -->
            <!-- modal editar Asesor (sin proceso) -->
            <div class="modal fade" id="editarAsesor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h2 class="modal-title mx-auto">Editar Asesor</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="salirModal" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class=" mx-auto d-block border border-dark rounded col-md-9">
                                <h3 class="mx-auto d-block mt-2 p-1 text-center"><span></span></h3>
                                <form id="formEditarAsesor" class="needs-validation mt-4 p-2 " method="POST" novalidate>

                                    <div class="form-group">
                                        <input class="idAsesor" type="hidden" name="idAsesor">
                                        <label for="nombre">Nombre:</label>
                                        <input type="text" class="form-control input-sm nombre" name="nombre" autocomplete="off" required>
 </div>
                                    
                                    <label for="usuario">Usuario:</label>
                                    <input type="text" class="form-control input-sm usuario" name="usuario" autocomplete="off" required>
                                    <div class="form-group">
                                        <label for="correo">Correo:</label>
                                        <input type="text" class="form-control input-sm correo" name="correo" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="celular">Celular:</label>
                                        <input type="text" class="form-control input-sm celular" name="celular" autocomplete="off" required>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-dismiss="modal" id="modalEditarAsesor" onclick="editarAsesor();">Editar Asesor</button>
                            <button type="button" class="btn btn-danger salirModal" data-dismiss="modal" id="salirModal">Cancelar</button>

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
            $('.mostrarTabla').load('tablas/tablaAsesores.php');

        });
    </script>

</body>

</html>