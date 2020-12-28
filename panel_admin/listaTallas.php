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
    <title>LISTA TALLAS</title>
    <link rel="shortcut icon" href="images/icono.png" />
    <?php include("includes/scriptUp.php") ?>
</head>


<body class="sb-nav-fixed ">
    <?php include("includes/navBar.php") ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <ol class="breadcrumb mb-3 mt-3">
                    <li class="breadcrumb-item "><a class="a-text-kmisetas" href="index.php">Inicio</a></li>
                    <li class="breadcrumb-item active">Lista Tallas</li>
                </ol>

                <!-- tabla -->
                <div class="card mb-4">
                    <div class="card-header ">
                        <div class="card-body d-flex justify-content-between align-items-center p-0">
                            Lista Tallas
                            <a href="#" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#ingresarTallas">Ingresar Tallas</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="tablaTallas"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODALES -->
            <!-- modal ingresar Tallas -->
            <div class="modal fade" id="ingresarTallas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h2 class="modal-title mx-auto">Ingresar Talla</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="salirModal" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class=" mx-auto d-block border border-dark rounded col-md-9">

                                <form id="formIngresarTallas" class="needs-validation p-2 " method="POST" novalidate>

                                    <div class="form-group text-center">
                                        <button type="button" title="Agregar Filas" class="btn btn-primary mr-2 font-weight-bold" onclick="agregarFila()"><i class="fas fa-plus-circle "></i></i></button>
                                        <button type="button" title="Eliminar Filas" class="btn btn-danger font-weight-bold" onclick="eliminarFila()"><i class="fas fa-minus-circle"></i></button>
                                    </div>
                                    <div class="form-group col-md-5 mx-auto text-center">
                                        <label for="siglas">Siglas:</label>
                                        <input type="text" name="siglas" id="siglas" class="form-control text-center" placeholder="" aria-describedby="helpId" autocomplete="off">

                                    </div>
                                    <div class="row mx-auto">
                                        <table border="1" class="table rounded" id="tablaprueba">
                                            <thead>
                                                <tr class="bg-dark text-white text-center">
                                                    <th style="width: 50px;">ID</th>
                                                    <th style="width: 100px;">Talla (max 15)</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">1</td>
                                                    <td><input type="text" name="tallas[]" class="form-control" autocomplete="off"></td>
                                                </tr>

                                            </tbody>
                                        </table>


                                    </div>

                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-dismiss="modal" id="modalEditarAsesor" onclick="ingresarTallas()">Ingresar Tallas</button>
                            <button type="button" class="btn btn-danger salirModal" data-dismiss="modal" id="salirModal">Cancelar</button>

                        </div>
                    </div>
                </div>



            </div>
            <!-- modal editar Tallas -->
            <div class="modal fade" id="editarTallas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h2 class="modal-title mx-auto">Ingresar Talla</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="salirModal" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class=" mx-auto d-block border border-dark rounded col-md-9">

                                <form id="formEditarTallas" class="needs-validation p-2 " method="POST" novalidate>
                                    
                                   <div class="cargaTallas"></div>
                                  

                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-dismiss="modal" id="modalEditarAsesor" onclick="editarTallas()">Editar Tallas</button>
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
            $('.tablaTallas').load('tablas/tablaTallas.php');

        });
    </script>
    <script>
        function agregarFila() {
            var table = document.getElementById("tablaprueba");
            var rowCount = table.rows.length;
            if (rowCount > 15) {
                Swal.fire({
                    position: 'center',
                    html: '<br><img src="images/logo_kamisetas.png" alt="" style="width:100px">',
                    title: '<br>No se puede ingresar más de 15 filas',
                    background: ' #000000cd',
                    showConfirmButton: false,
                    timer: 2000,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false,
                    backdrop: false,
                });
            } else {
                document.getElementById("tablaprueba").insertRow(-1).innerHTML = '<td class="text-center">' + rowCount + '</td><td><input type="text" name="tallas[]" class="form-control" autocomplete="off"></td>';
                /*  console.log(rowCount); */
            }

        }

        function eliminarFila() {
            var table = document.getElementById("tablaprueba");
            var rowCount = table.rows.length;
            /* console.log(rowCount); */

            if (rowCount <= 1) {
                Swal.fire({
                    position: 'center',
                    html: '<br><img src="images/logo_kamisetas.png" alt="" style="width:100px">',
                    title: '<br>No se puede eliminar el encabezado',
                    background: ' #000000cd',
                    showConfirmButton: false,
                    timer: 2000,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false,
                    backdrop: false,
                });
            } else {
                table.deleteRow(rowCount - 1);
            }
        }
    </script>

</body>

</html>