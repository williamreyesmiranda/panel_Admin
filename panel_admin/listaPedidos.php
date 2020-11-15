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
            <div class="modal fade" id="modalEditarPedido" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title  mx-auto" id="">Editar Pedido</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="salirModal" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class=" mx-auto d-block border border-dark rounded col-md-9">
                                <h3 class="mx-auto d-block mt-2 p-1 text-center"><span id="idview"></span></h3>
                                <form action="registrarProducto.php" id="formEditarPedido"
                                    class="needs-validation mt-4 p-2 " method="POST" novalidate>

                                    <div class="form-group">
                                        <input type="hidden" name="idPedido" id="idPedido">
                                        <input type="text" class="form-control input-sm" id="enroPedido"
                                            name="nroPedido" placeholder="Nro Pedido (*)" autocomplete="off" required>
                                        <!-- <div class="valid-feedback">Listo</div> -->
                                        <div class="invalid-feedback">Ingrese el Nro de Pedido</div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $conexion = new Conexion();
                                        $consultaSQL = "SELECT * FROM clientes order by nombre asc";
                                        $clientes = $conexion->consultarDatos($consultaSQL);

                                        ?>


                                        <input list="enombreliente" name="nombreCliente" id="enombreCliente"
                                            class="form-control col-md-12"
                                            placeholder="Ingrese el nombre del Cliente" /></label>
                                        <datalist name="enombreliente" id="enombreliente">
                                            <?php foreach ($clientes as $cliente) : ?>
                                            <option value="<?php echo ($cliente['nombre']) ?>"></option>
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

                                        <input list="asesor" name="asesor" id="easesor" class="form-control"
                                            placeholder="Asesor (*)" autocomplete="off" required></label>
                                        <datalist name="asesor" id="asesor">
                                            <?php foreach ($asesores as $asesor) : ?>
                                            <option value="<?php echo $asesor['usuario'] ?>"></option>
                                            <?php endforeach; ?>
                                        </datalist>

                                        <!-- <div class="valid-feedback">Listo</div> -->
                                        <div class="invalid-feedback">Ingrese el Asesor.</div>
                                    </div>


                                    <div class="form-group">
                                        <label for="efechaInicio">Fecha Inicio: (*)</label>
                                        <input type="date" class="form-control input-sm" id="efechaInicio"
                                            name="fechaInicio" required>
                                        <!-- <div class="valid-feedback">Listo</div> -->
                                        <div class="invalid-feedback">Por Favor Ingrese Fecha</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="efechaFin">Fecha Final: (*)</label>
                                        <input type="date" class="form-control input-sm" id="efechaFin" name="fechaFin"
                                            required>
                                        <!-- <div class="valid-feedback">Listo</div> -->
                                        <div class="invalid-feedback">Por Favor Ingrese Fecha</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Días Hábiles</label>
                                        <div id="ediashabiles" class="form-control input-sm"></div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="eunds">Unds: (*)</label>
                                        <input type="number" class="form-control input-sm " id="eunds" placeholder=""
                                            name="unds" required>
                                        <!-- <div class="valid-feedback">Listo</div> -->
                                        <div class="invalid-feedback">Por Favor Ingrese Fecha</div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="eprocesos">Procesos (*)</label>
                                        <input type="text" class="form-control input-sm" id="eprocesos" placeholder=""
                                            name="procesos" required readonly>
                                        <!-- <div class="valid-feedback">Listo</div> -->
                                        <div class="invalid-feedback">Por Favor Ingrese Fecha</div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-dismiss="modal" id="modalEditarPedido"
                                onclick="editarPedido();">Editar Pedido</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"
                                id="salirModal">Cancelar</button>

                        </div>
                    </div>
                </div>



            </div>
            <!-- modal editar pedido (solo proceso) -->
            <div class="modal fade" id="modalEditarProceso" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title  mx-auto" id="">Editar Proceso</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="salirModal" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class=" mx-auto d-block border border-dark rounded col-md-9">
                                <h3 class="mx-auto d-block mt-2 p-1 text-center"><span id="idview"></span></h3>
                                <form action="registrarProducto.php" id="formEditarPedido"
                                    class="needs-validation mt-4 p-2 " method="POST" novalidate>

                                    <div class="form-group">
                                        <input type="hidden" name="idPedido" id="idPedido">
                                        <input type="text" class="form-control input-sm" id="enroPedido"
                                            name="nroPedido" placeholder="Nro Pedido (*)" autocomplete="off" required>
                                        <!-- <div class="valid-feedback">Listo</div> -->
                                        <div class="invalid-feedback">Ingrese el Nro de Pedido</div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $conexion = new Conexion();
                                        $consultaSQL = "SELECT * FROM clientes order by nombre asc";
                                        $clientes = $conexion->consultarDatos($consultaSQL);

                                        ?>


                                        <input list="enombreliente" name="nombreCliente" id="enombreCliente"
                                            class="form-control col-md-12"
                                            placeholder="Ingrese el nombre del Cliente" /></label>
                                        <datalist name="enombreliente" id="enombreliente">
                                            <?php foreach ($clientes as $cliente) : ?>
                                            <option value="<?php echo ($cliente['nombre']) ?>"></option>
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

                                        <input list="asesor" name="asesor" id="easesor" class="form-control"
                                            placeholder="Asesor (*)" autocomplete="off" required></label>
                                        <datalist name="asesor" id="asesor">
                                            <?php foreach ($asesores as $asesor) : ?>
                                            <option value="<?php echo $asesor['usuario'] ?>"></option>
                                            <?php endforeach; ?>
                                        </datalist>

                                        <!-- <div class="valid-feedback">Listo</div> -->
                                        <div class="invalid-feedback">Ingrese el Asesor.</div>
                                    </div>


                                    <div class="form-group">
                                        <label for="efechaInicio">Fecha Inicio: (*)</label>
                                        <input type="date" class="form-control input-sm" id="efechaInicio"
                                            name="fechaInicio" required>
                                        <!-- <div class="valid-feedback">Listo</div> -->
                                        <div class="invalid-feedback">Por Favor Ingrese Fecha</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="efechaFin">Fecha Final: (*)</label>
                                        <input type="date" class="form-control input-sm" id="efechaFin" name="fechaFin"
                                            required>
                                        <!-- <div class="valid-feedback">Listo</div> -->
                                        <div class="invalid-feedback">Por Favor Ingrese Fecha</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Días Hábiles</label>
                                        <div id="ediashabiles" class="form-control input-sm"></div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="eunds">Unds: (*)</label>
                                        <input type="number" class="form-control input-sm " id="eunds" placeholder=""
                                            name="unds" required>
                                        <!-- <div class="valid-feedback">Listo</div> -->
                                        <div class="invalid-feedback">Por Favor Ingrese Fecha</div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="eprocesos">Procesos (*)</label>
                                        <input type="text" class="form-control input-sm" id="eprocesos" placeholder=""
                                            name="procesos" required readonly>
                                        <!-- <div class="valid-feedback">Listo</div> -->
                                        <div class="invalid-feedback">Por Favor Ingrese Fecha</div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-dismiss="modal" id="modalEditarPedido"
                                onclick="editarPedido();">Editar Pedido</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"
                                id="salirModal">Cancelar</button>

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

        $('#modalEditarPedido').click(function() {

        });
        $('.salirModal, #salirModal').click(function() {
            alertify.error("Se Canceló Proceso");
        });

    });
    </script>

</body>

</html>