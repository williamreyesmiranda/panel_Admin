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
    <title>LISTA PEDIDOS</title>
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
                    <li class="breadcrumb-item active">Lista Pedidos</li>
                </ol>

                <!-- tabla -->
                <div class="card mb-4">
                    <div class="card-header ">
                        <i class="fas fa-table mr-1"></i> Lista de Pedidos Para Bodega
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="mostrarTabla"></div>
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
            <!-- modal editar Bodega -->
            <div class="modal fade" id="editarBodega" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h2 class="modal-title mx-auto">Editar Bodega</h2>
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

                                <form id="formEditarBodega" class="" method="POST" novalidate>
                                    <input type="hidden" name="idPedido" class="idPedido">
                                    <input type="hidden" name="idBodega" class="idBodega">
                                    <div class="form-group text-center col-md-5 mx-auto">
                                        <label for="parcial">Parcial:</label>
                                        <input type="number" name="parcial" id="parcial" class="form-control parcial" aria-describedby="helpId">
                                    </div>
                                    <div class="form-group text-center ">
                                        <label for="obs_bodega">Parcial:</label>
                                        <textarea name="obs_bodega" id="obs_bodega" class="form-control obs_bodega" rows="5"></textarea>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-dismiss="modal" id="modalEditarBodega" onclick="editarBodega();">Editar Pedido</button>
                            <button type="button" class="btn btn-danger salirModal" data-dismiss="modal" id="salirModal">Cancelar</button>

                        </div>
                    </div>
                </div>
            </div>
            <!-- modal editar pedido (solo proceso) -->
            <div class="modal fade" id="editarProceso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title mx-auto">Editar Proceso</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="salirModal" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class=" mx-auto d-block border border-dark rounded col-md-9">
                                <h3 class="mx-auto d-block mt-2 p-1 text-center"><span></span></h3>
                                <form id="formEditarProceso" class="needs-validation mt-4 p-2 " method="POST" novalidate>

                                    <div class="form-group">
                                        <input class="idPedidoEditar" type="hidden" name="idPedido">

                                        <input type="hidden" name="asesor" class=" asesorEdit">
                                        <input type="hidden" class=" inicioEditar" name="fechaInicio">
                                        <input type="hidden" class="finEditar" name="fechaFin">
                                        <input type="hidden" class="diasEditar" type="text " name="diasEditar">
                                        <label for="">Nro Pedido:</label>
                                        <input type="text" class="form-control input-sm nroPedidoEditar" name="nroPedido" readonly>

                                    </div>
                                    <div class="form-group">
                                        <label for="">Cliente:</label>
                                        <input type="text" name="clienteEditar" class="form-control clienteEdit" value="" readonly></label>
                                    </div>

                                    <div class="form-group ">
                                        <label for="undsEditar">Unds: (*)</label>
                                        <input type="number" class="form-control input-sm undsEditar" name="undsEditar" readonly>
                                    </div>

                                    <div class="form-group">
                                        <?php
                                        $conexion = new Conexion();
                                        $consultaSQL = "SELECT * FROM procesos ";
                                        $procesos = $conexion->consultarDatos($consultaSQL);
                                        ?>
                                        <input list="procesosProceso" name="procesosProceso" class="form-control procesosEditar" value="" placeholder="Procesos (*)" autocomplete="off" required></label>
                                        <datalist name="procesosProceso" id="procesosProceso">
                                            <?php foreach ($procesos as $proceso) : ?>
                                                <option value="<?php echo $proceso['siglas'] ?>"></option>
                                            <?php endforeach; ?>
                                        </datalist>
                                    </div>


                                    <div class="diasProcesoEditar"></div>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-dismiss="modal" id="modalEditarPedido" onclick="editarProceso();">Editar Pedido</button>
                            <button type="button" class="btn btn-danger salirModal" data-dismiss="modal">Cancelar</button>

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
            $('.mostrarTabla').load('tablas/tablaBodega.php');

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