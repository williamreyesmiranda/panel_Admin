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
    <title>LISTA BORDADO</title>
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
                    <li class="breadcrumb-item "><a class="a-text-kmisetas" href="reporteBordado.php">Reporte Bordado</a></li>
                    <li class="breadcrumb-item active">Lista Bordado</li>
                </ol>

                <!-- tabla -->
                <div class="card mb-4">
                    <div class="card-header ">
                        <i class="fas fa-table mr-1"></i> Lista de Pedidos Para Bordado
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="tablabordado"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODALES -->
            <!-- modal editar bordado -->
            <div class="modal fade" id="editarBordado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h2 class="modal-title mx-auto">Editar Bordado</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="salirModal" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class=" mx-auto d-block border border-dark rounded col-md-9 mb-2 py-2">
                                <div class="nroPedido"></div>
                                <div class="cliente"></div>
                                <div class="asesor"></div>
                                <div class="inicio"></div>
                                <div class="fin"></div>
                                <div class="procesos"></div>
                                <div class="unds"></div>
                            </div>
                            <div class=" mx-auto d-block border border-dark rounded col-md-9">
                                <h3 class="mx-auto d-block mt-2 p-1 text-center"><span></span></h3>

                                <form id="formEditarBordado" class="" method="POST" novalidate>
                                    <input type="hidden" name="idPedido" class="idPedido">
                                    <input type="hidden" name="idBordado" class="idBordado">
                                    <div class="row ">
                                        <div class="form-group col-md-6 ">
                                            <label for="pte_diseno">Diseño:</label>
                                            <select name="pte_diseno" id="pte_diseno" class="custom-select pte_diseno">
                                                <option value=""></option>
                                                <option value="X">X</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6 ">
                                            <label for="muestra">Muestra:</label>
                                            <select name="muestra" id="muestra" class="custom-select muestra">
                                                <option value=""></option>
                                                <option value="X">X</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for=" logo">Logo:</label>
                                        <input type="text" name=" logo" id=" logo" class="form-control logo" placeholder="" aria-describedby="helpId">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-5 ">
                                            <label for="num_bordado">N° Bord:</label>
                                            <select name="num_bordado" id="num_bordado" class="custom-select num_bordado">
                                                <option value="0"></option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-7">
                                            <label for="punt_unidad">Punt X und:</label>
                                            <input type="number" name="punt_unidad" id="punt_unidad" class="form-control punt_unidad" placeholder="" aria-describedby="helpId">
                                        </div>
                                    </div>
                                    <div class="form-group text-center col-md-5 mx-auto">
                                        <label for="parcial">Parcial:</label>
                                        <input type="number" name="parcial" id="parcial" class="form-control parcial" aria-describedby="helpId">
                                    </div>
                                    <div class="form-group text-center ">
                                        <label for="obs_bordado">Observación:</label>
                                        <textarea name="obs_bordado" id="obs_bordado" class="form-control obs_bordado" rows="5"></textarea>
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" name="btnEditarBordado" data-dismiss="modal" id="modalEditarBordado" onclick="editarBordado();">Editar Pedido</button>
                                <button type="button" class="btn btn-danger salirModal" data-dismiss="modal" id="salirModal">Cancelar</button>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- modal novedad Bordado -->
            <div class="modal fade" id="novedadBordado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h2 class="modal-title mx-auto">Reportar Novedad</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="salirModal" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class=" mx-auto d-block border border-dark rounded col-md-9 mb-2 py-2">
                                <div class="nroPedido"></div>
                                <div class="cliente"></div>
                                <div class="asesor"></div>
                                <div class="correoAsesor"></div>
                                <div class="inicio"></div>
                                <div class="fin"></div>
                                <div class="procesos"></div>
                                <div class="unds"></div>

                            </div>
                            <div class=" mx-auto d-block border border-dark rounded col-md-9">
                                <h3 class="mx-auto d-block mt-2 p-1 text-center"><span>Escribe la Novedad!!</span></h3>

                                <form id="formNovedadBordado" class="formFinalizarNovedad" method="POST" novalidate>
                                    <input type="hidden" name="idPedido" class="idPedido">
                                    <input type="hidden" name="idNovedad" class="idNovedad">
                                    <input type="hidden" name="asesor" class="asesor">
                                    <input type="hidden" name="nroPedido" class="nroPedido">
                                    <input type="hidden" name="cliente" class="cliente">
                                    <div class="form-group text-center ">
                                        <label for="novedad">Novedad:</label>
                                        <textarea name="novedad" id="novedad" class="form-control novedad" rows="5"></textarea>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="novedadBordado();">Reportar Novedad</button>
                            <button type="button" class="btn btn-success" data-dismiss="modal" onclick="finalizarNovedad();">Finalizar Novedad</button>
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
            $('.tablabordado').load('tablas/tablaBordado.php');
        });
    </script>

</body>

</html>