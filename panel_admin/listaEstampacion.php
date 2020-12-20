<!DOCTYPE html>
<html lang="es">

<?php
session_set_cookie_params(60 * 60 * 24);
session_start();
include("../db/Conexion.php");
if (empty($_SESSION['active'])) {
    header('location: ../');
}
$area = "estampacion";
?>



<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>LISTA ESTAMPACIÓN</title>
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
                    <li class="breadcrumb-item "><a class="a-text-kmisetas" href="reporteEstampacion.php">Reporte Estampación</a></li>
                    <li class="breadcrumb-item active">Lista Estampación</li>
                </ol>

                <!-- tabla -->
                <div class="card mb-4">
                    <div class="card-header ">
                        <div class="card-body d-flex justify-content-between align-items-center p-0">
                            Lista de Pedidos Para Estampación
                            <a href="#" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#restaurarPedido">Restaurar Pedidos</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="tablaestampacion"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODALES -->
            <!-- modal editar estampacion -->
            <div class="modal fade" id="editarEstampacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h2 class="modal-title mx-auto">Editar Estampación</h2>
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

                                <form id="formEditarEstampacion" class="" method="POST" novalidate>
                                    <input type="hidden" name="idPedido" class="idPedido">
                                    <input type="hidden" name="idEstampacion" class="idEstampacion">
                                    <div class="form-row mx-auto text-center">
                                        <div class="form-group text-center col-md-2">
                                            <label for="arte_diseno">AD:</label>
                                            <select name="arte_diseno" id="arte_diseno" class="custom-select arte_diseno">
                                                <option value=""></option>
                                                <option value="✓">✓</option>
                                            </select>
                                        </div>
                                        <div class="form-group text-center col-lg-2">
                                            <label for="arte_impresion">AI:</label>
                                            <select name="arte_impresion" id="arte_impresion" class="custom-select arte_impresion">
                                                <option value=""></option>
                                                <option value="✓">✓</option>
                                            </select>
                                        </div>
                                        <div class="form-group text-center col-md-2">
                                            <label for="grabacion">Grab:</label>
                                            <select name="grabacion" id="grabacion" class="custom-select grabacion">
                                                <option value=""></option>
                                                <option value="✓">✓</option>
                                            </select>
                                        </div>
                                        <div class="form-group text-center col-md-2">
                                            <label for="estampacion">Estamp:</label>
                                            <select name="estampacion" id="estampacion" class="custom-select estampacion">
                                                <option value=""></option>
                                                <option value="✓">✓</option>
                                            </select>
                                        </div>
                                        <div class="form-group text-center col-md-2">
                                            <label for="sublimacion">Sublim:</label>
                                            <select name="sublimacion" id="sublimacion" class="custom-select sublimacion">
                                                <option value=""></option>
                                                <option value="✓">✓</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group text-center col-md-8 mx-auto">
                                        <label for="tecnica">Técnica:</label>
                                        <select name="tecnica" id="tecnica" class="custom-select tecnica">
                                            <option value="">Selecciones una Opción</option>
                                            <option value="TEXTIL">TEXTIL</option>
                                            <option value="PLASTISOL">PLASTISOL</option>
                                            <option value="VINILO">VINILO</option>
                                            <option value="CORROSION">CORROSION</option>
                                            <option value="TEXT/CORR">TEXT/CORR</option>
                                            <option value="PLAST/CORR">PLAST/CORR</option>
                                            <option value="PLAST/TEXT">PLAST/TEXT</option>
                                        </select>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group text-center col-md-3">
                                            <label for="nro_diseno">N° Dise:</label>
                                            <select name="nro_diseno" id="nro_diseno" class="custom-select nro_diseno">
                                                <option value="0"></option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                            </select>
                                        </div>
                                        <div class="form-group text-center col-md-3">
                                            <label for="posicion">Posición:</label>
                                            <select name="posicion" id="posicion" class="custom-select posicion">
                                                <option value="0"></option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                            </select>
                                        </div>
                                        <div class="form-group text-center col-md-3">
                                            <label for="seda">Seda:</label>
                                            <select name="seda" id="seda" class="custom-select seda">
                                                <option value="0"></option>
                                                <option value="55">55</option>
                                                <option value="64">64</option>
                                                <option value="77">77</option>
                                                <option value="100">100</option>
                                                <option value="120">120</option>
                                            </select>
                                        </div>
                                        <div class="form-group text-center col-md-3">
                                            <label for="nro_plancha">N° Planc:</label>
                                            <input type="number" name="nro_plancha" id="nro_plancha" class="form-control nro_plancha">
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <label for="fren">Frente:</label>
                                        <input type="text" name="fren" id="fren" class="form-control fren">
                                    </div>
                                    <div class="form-group text-center">
                                        <label for="esp">Espalda:</label>
                                        <input type="text" name="esp" id="esp" class="form-control esp">
                                    </div>
                                    <div class="form-group text-center">
                                        <label for="otro">Otro:</label>
                                        <input type="text" name="otro" id="otro" class="form-control otro">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group text-center col-md-4">
                                            <label for="prep">Preparación:</label>
                                            <input type="number" name="prep" id="prep" class="form-control prep">
                                        </div>
                                        <div class="form-group text-center col-md-4">
                                            <label for="est">Estampación:</label>
                                            <input type="number" name="est" id="est" class="form-control est">
                                        </div>
                                        <div class="form-group text-center col-md-4">
                                            <label for="sub">Sublimación:</label>
                                            <input type="number" name="sub" id="sub" class="form-control sub">
                                        </div>
                                    </div>

                                    <div class="form-group text-center col-md-5 mx-auto">
                                        <label for="parcial">Parcial:</label>
                                        <input type="number" name="parcial" id="parcial" class="form-control parcial" aria-describedby="helpId">
                                    </div>
                                    <div class="form-group text-center ">
                                        <label for="obs_estampacion">Observación:</label>
                                        <textarea name="obs_estampacion" id="obs_estampacion" class="form-control obs_estampacion" rows="5"></textarea>
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" name="btnEditarEstampacion" data-dismiss="modal" id="modalEditarEstampacion" onclick="editarEstampacion();">Editar Pedido</button>
                                <button type="button" class="btn btn-danger salirModal" data-dismiss="modal" id="salirModal">Cancelar</button>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- modal novedad Estampacion -->
            <div class="modal fade" id="novedadEstampacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
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

                                <form id="formNovedadEstampacion" class="formFinalizarNovedad" method="POST" novalidate>
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
                            <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="novedadEstampacion();">Reportar Novedad</button>
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
            $('.tablaestampacion').load('tablas/tablaEstampacion.php');
        });
    </script>

</body>

</html>