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
    <title>LISTA CORTE</title>
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
                    <li class="breadcrumb-item active">Lista Pedidos</li>
                </ol>

                <!-- tabla -->
                <div class="card mb-4">
                    <div class="card-header ">
                        <i class="fas fa-table mr-1"></i> Lista de Pedidos Para Corte
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="tablacorte"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODALES -->
            <!-- modal ver pedido  -->
            <div class="modal fade" id="verPedido" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h2 class="modal-title text-center">Información Detallada del Pedido</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class=" mx-auto d-block border border-dark rounded col-md-9">
                                <h3 class="mx-auto d-block mt-2 p-1 text-center"><span></span></h3>


                                <div class="form-group">
                                    <input type="text" class="form-control input-sm nroPedido" readonly>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control cliente" readonly>

                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control asesor" readonly>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control input-sm inicio" readonly>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control input-sm fin" readonly>
                                </div>
                                <div class="form-group">
                                    <input class="form-control input-sm dias" type="text " readonly>

                                </div>
                                <div class="form-group ">
                                    <input type="text" class="form-control input-sm unds" readonly>
                                </div>

                                <div class="form-group ">
                                    <input type="text" class="form-control input-sm procesos" readonly>
                                </div>
                                <div class="form-group ">
                                    <input type="text" class="form-control input-sm estadoPedido" readonly>
                                </div>


                            </div>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-dark " data-dismiss="modal" id="">Aceptar</button>

                        </div>
                    </div>
                </div>



            </div>
            <!-- modal editar corte -->
            <div class="modal fade" id="editarCorte" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h2 class="modal-title mx-auto">Editar Corte</h2>
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

                                <form id="formEditarCorte" class="" method="POST" novalidate>
                                    <input type="hidden" name="idPedido" class="idPedido">
                                    <input type="hidden" name="idCorte" class="idCorte">
                                    <div class="form-group text-center col-md-5 mx-auto">
                                        <label for="parcial">Parcial:</label>
                                        <input type="number" name="parcial" id="parcial" class="form-control parcial" aria-describedby="helpId">
                                    </div>
                                    <div class="form-group text-center col-md-6 mx-auto">
                                        <label for="oc">OC:</label>
                                        <input type="text" name="oc" id="oc" class="form-control oc" aria-describedby="helpId">
                                    </div>
                                    
                                    <div class="form-group text-center ">
                                        <label for="obs_corte">Observación:</label>
                                        <textarea name="obs_corte" id="obs_corte" class="form-control obs_corte" rows="5"></textarea>
                                    </div>
                                    
                                </form>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-dark" name="btnEditarCorte"data-dismiss="modal" id="modalEditarCorte" onclick="editarCorte();">Editar Pedido</button>
                            <button type="button" class="btn btn-danger salirModal" data-dismiss="modal" id="salirModal">Cancelar</button>

                        </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- modal novedad Corte -->
            <div class="modal fade" id="novedadCorte" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
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

                                <form id="formNovedadCorte" class="formFinalizarNovedad" method="POST" novalidate>
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
                            <button type="button" class="btn btn-warning" data-dismiss="modal"  onclick="novedadCorte();">Reportar Novedad</button>
                            <button type="button" class="btn btn-success" data-dismiss="modal"  onclick="finalizarNovedad();">Finalizar Novedad</button>
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
            $('.tablacorte').load('tablas/tablaCorte.php');
});
    </script>

</body>

</html>