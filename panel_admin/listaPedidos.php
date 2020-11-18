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
                    <li class="breadcrumb-item active">Lista Pedidos</li>
                </ol>

                <!-- tabla -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i> Lista de Pedidos Pendientes
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="mostrarTabla"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODALES -->
            <!-- modal editar pedido (sin proceso) -->
            <div class="modal fade" id="editarPedido" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h2 class="modal-title mx-auto">Editar Pedido</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="salirModal" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class=" mx-auto d-block border border-dark rounded col-md-9">
                                <h3 class="mx-auto d-block mt-2 p-1 text-center"><span></span></h3>
                                <form id="formEditarPedido" class="needs-validation mt-4 p-2 " method="POST" novalidate>

                                    <div class="form-group">
                                        <input class="idPedidoEditar" type="hidden" name="idPedidoEditar">
                                        <input type="hidden" name="procesos" class="idProcesosEditar">
                                        <input type="text" class="form-control input-sm nroPedidoEditar" name="nroPedidoEditar" value="" placeholder="Nro Pedido (*)" autocomplete="off" required>
                                        <!-- <div class="valid-feedback">Listo</div> -->
                                        <div class="invalid-feedback">Ingrese el Nro de Pedido</div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $conexion = new Conexion();
                                        $consultaSQL = "SELECT * FROM clientes order by nombre asc";
                                        $clientes = $conexion->consultarDatos($consultaSQL);
                                        ?>
                                        <input list="clienteEditar" name="clienteEditar" id="clienteEdit" class="form-control clienteEdit" value="" placeholder="Cliente (*)" autocomplete="off" required></label>
                                        <datalist name="clienteEditar" id="clienteEditar">
                                            <?php foreach ($clientes as $cliente) : ?>
                                                <option value="<?php echo $cliente['nombre'] ?>"></option>
                                            <?php endforeach; ?>
                                        </datalist>

                                        <!-- <div class="valid-feedback">Listo</div> -->
                                        <div class="invalid-feedback">Ingrese el Nombre del Cliente.</div>
                                    </div>

                                    <div class="form-group">
                                        <?php

                                        $consultaAsesor = "SELECT * FROM asesor order by usuario asc";
                                        $asesores = $conexion->consultarDatos($consultaAsesor);
                                        ?>

                                        <input list="asesorEditar" name="asesor" id="asesorEdit" class="form-control asesorEdit" value="" placeholder="Asesor (*)" autocomplete="off" required></label>
                                        <datalist name="asesorEditar" id="asesorEditar">
                                            <?php foreach ($asesores as $asesor) : ?>
                                                <option value="<?php echo $asesor['usuario'] ?>"></option>
                                            <?php endforeach; ?>
                                        </datalist>

                                        <!-- <div class="valid-feedback">Listo</div> -->
                                        <div class="invalid-feedback">Ingrese el Asesor.</div>
                                    </div>


                                    <div class="form-group">
                                        <label for="inicioEditar">Fecha Inicio: (*)</label>
                                        <input type="date" class="form-control input-sm inicioEditar" id="inicioEditar" name="fechaInicio" value="" required>
                                        <!-- <div class="valid-feedback">Listo</div> -->
                                        <div class="invalid-feedback">Por Favor Ingrese Fecha</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="finEditar">Fecha Final: (*)</label>
                                        <input type="date" class="form-control input-sm finEditar" id="finEditar" name="fechaFin" value="" required>
                                        <!-- <div class="valid-feedback">Listo</div> -->
                                        <div class="invalid-feedback">Por Favor Ingrese Fecha</div>
                                    </div>
                                    <div class="form-group">
                                        <label>Días Hábiles</label>
                                        <input class="form-control input-sm diasEditar diasEditar" type="text " name="diasEditar" id="diasEditar" readonly>
                                        <!-- <div class="form-control input-sm"><span id="diasEditar" name='diasEditar'></span></div> -->
                                    </div>
                                    <div class="form-group ">
                                        <label for="undsEditar">Unds: (*)</label>
                                        <input type="number" class="form-control input-sm undsEditar" value="" id="undsEditar" placeholder="" name="undsEditar" required>
                                        <!-- <div class="valid-feedback">Listo</div> -->
                                        <div class="invalid-feedback">Por Favor Ingrese Fecha</div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="">Procesos (*)</label>
                                        <input type="text" class="form-control input-sm procesosEditar" id="procesosEditar" readonly>
                                        <!-- <div class="valid-feedback">Listo</div> -->
                                        <div class="invalid-feedback">Por Favor Ingrese Fecha</div>
                                    </div>
                                    <div class="diasProcesoEditar"></div>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-dismiss="modal" id="modalEditarPedido" onclick="editarPedido();">Editar Pedido</button>
                            <button type="button" class="btn btn-danger salirModal" data-dismiss="modal" id="salirModal" >Cancelar</button>

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
                            <button type="button" class="btn btn-danger salirModal" data-dismiss="modal"  >Cancelar</button>

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
$('.procesosCargar').change(function () { 
  
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