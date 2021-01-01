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
    <title>LISTA REFERENCIAS</title>
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
                    <li class="breadcrumb-item active">Lista Referencias</li>
                </ol>

                <!-- tabla -->
                <div class="card mb-4">
                    <div class="card-header ">
                        <div class="card-body d-flex justify-content-between align-items-center p-0">
                            Lista Referencias
                            <a href="#" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#ingresarReferencia">Ingresar Referencia</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="tablaReferencias"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODALES -->
            <!-- modal ingresar Referencias -->
            <div class="modal fade" id="ingresarReferencia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h2 class="modal-title mx-auto">Ingresar Referencia</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="salirModal" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class=" mx-auto d-block border border-dark rounded col-md-9">

                                <form id="formIngresarReferencias" class="needs-validation p-2 " method="POST" novalidate>

                                    <div class="form-group col-md-5 mx-auto text-center">
                                        <label for="codigo">Código:</label>
                                        <input type="text" name="codigo" class="form-control text-center codigo" placeholder="" aria-describedby="helpId" autocomplete="off">

                                    </div>
                                    <div class="form-group col-md-7 mx-auto text-center">
                                        <label for="talla">Talla:</label>
                                        <select name="talla" class="custom-select talla">
                                            <option value="" disabled selected>Seleccione una Talla</option>
                                            <?php
                                            $conexion = new Conexion();
                                            $consultaSQL = "SELECT * FROM tallas order by siglas";
                                            $tallas = $conexion->consultarDatos($consultaSQL);
                                            foreach ($tallas as $talla) :
                                            ?>
                                                <option value="<?php echo ($talla['idTalla']) ?>"><?php echo ($talla['siglas']) ?></option>
                                            <?php endforeach ?>
                                        </select>


                                    </div>


                                    <div class="form-group">
                                        <label for="descripcion">Nombre Referencia:</label>
                                        <input type="text" name="descripcion" class="form-control descripcion" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="correo">Correos (Separados por punto y coma):</label>
                                        <textarea class="form-control correo" name="correo" rows="3"></textarea>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-dismiss="modal" id="modalEditarAsesor" onclick="ingresarReferencias()">Ingresar Referencia</button>
                            <button type="button" class="btn btn-danger salirModal" data-dismiss="modal" id="salirModal">Cancelar</button>

                        </div>
                    </div>
                </div>
            </div>

            <!-- modal editar Tallas -->
            <div class="modal fade" id="editarReferencias" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h2 class="modal-title mx-auto">Ingresar Referencia</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="salirModal" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class=" mx-auto d-block border border-dark rounded col-md-9">

                                <form id="formEditarReferencias" class="needs-validation p-2 " method="POST" novalidate>
                                    <div class="form-group col-md-4 mx-auto text-center">
                                        <label for="idReferencia" class="font-weight-bold">ID</label>
                                        <input type="text" name="idReferencia" id="idReferencia" class="form-control idReferencia text-center" readonly>
                                    </div>
                                    <div class="form-group col-md-5 mx-auto text-center">
                                        <label for="codigo">Código:</label>
                                        <input type="text" name="codigo" id="codigo" class="form-control text-center codigo" placeholder="" aria-describedby="helpId" autocomplete="off">

                                    </div>
                                    <div class="form-group col-md-7 mx-auto text-center">
                                        <label for="talla">Talla:</label>
                                        <select name="talla" class="custom-select talla">
                                            <option value="" disabled selected>Seleccione una Talla</option>
                                            <?php
                                            $conexion = new Conexion();
                                            $consultaSQL = "SELECT * FROM tallas order by siglas";
                                            $tallas = $conexion->consultarDatos($consultaSQL);
                                            foreach ($tallas as $talla) :
                                            ?>
                                                <option value="<?php echo ($talla['idTalla']) ?>"><?php echo ($talla['siglas']) ?></option>
                                            <?php endforeach ?>
                                        </select>


                                    </div>
                                    <div class="form-group">
                                        <label for="descripcion">Nombre Referencia:</label>
                                        <input type="text" name="descripcion" id="descripcion" class="form-control descripcion" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="correo">Correos (Separados por punto y coma):</label>
                                        <textarea class="form-control correo" name="correo" rows="3"></textarea>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-dismiss="modal" id="modalEditarAsesor" onclick="editarReferencias()">Editar Referencia</button>
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
            $('.tablaReferencias').load('tablas/tablaReferencias.php');
            $('.select2').select2();
        });
    </script>

</body>

</html>