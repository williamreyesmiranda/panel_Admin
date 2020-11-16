<table class="table table-hover table-condensed table-bordered" id="tablaDinamica" width="100%" cellspacing="0">
    <thead>
        <tr class="text-center">
            <th>Pedido</th>
            <th>Cliente</th>
            <th>Asesor</th>
            <th>Fecha Inicio</th>
            <th>Fecha Entrega</th>
            <th>Días Hab</th>
            <th>Días Falta</th>
            <th>Proc</th>
            <th>Est Pedido</th>
            <th>Unds</th>
            <th>Usuario</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tfoot>
        <tr class="text-center">
            <th>Pedido</th>
            <th>Cliente</th>
            <th>Asesor</th>
            <th>Fecha Inicio</th>
            <th>Fecha Entrega</th>
            <th>Días Hab</th>
            <th>Días Falta</th>
            <th>Proc</th>
            <th>Est Pedido</th>
            <th>Unds</th>
            <th>Usuario</th>
            <th>Acciones</th>
        </tr>
    </tfoot>
    <tbody>

        <?php include("../../db/Conexion.php");
        include("../php/funcionFecha.php");


        $conexion = new Conexion();
        $consultaSQL = "SELECT * FROM pedidos pe
                                    INNER JOIN procesos pr ON pe.procesos=pr.idproceso
                                    INNER JOIN estado est ON est.id_estado=pe.estado
                                    INNER JOIN usuario us ON us.idusuario=pe.usuario
                                    WHERE pe.estado<3";
        $pedidos = $conexion->consultarDatos($consultaSQL);
        foreach ($pedidos as $pedido) :
            $hoy = date('Y-m-d');
            $diapedido = $pedido['fecha_fin'];
            $diafaltapedido =  fechaToDays($hoy, $diapedido) - 1;
            if ($diafaltapedido < 0) {
                $diafaltapedido =  - (fechaToDays($diapedido, $hoy) - 1);
            }

            $datos = $pedido['idpedido'] . "||" . $pedido['num_pedido'] . "||" . $pedido['cliente'] . "||" . $pedido['asesor'] . "||" . $pedido['fecha_inicio'] . "||" .
                $pedido['fecha_fin'] . "||" . $pedido['siglas'] . "||" . $pedido['unds'] . "||" . $pedido['dias_habiles'];


        ?>
            <tr>
                <td><?php echo ($pedido['num_pedido']); ?></td>
                <td><?php echo ($pedido['cliente']); ?></td>
                <td><?php echo ($pedido['asesor']); ?></td>
                <td><?php echo ($pedido['fecha_inicio']); ?></td>
                <td><?php echo ($pedido['fecha_fin']); ?></td>
                <td><?php echo ($pedido['dias_habiles']); ?></td>
                <?php
                if ($diafaltapedido > 3) {
                    echo "<td class=\"alert-success\">" . $diafaltapedido . "</td>";
                } elseif ($diafaltapedido >= 0) {
                    echo "<td class=\"alert-warning\">" . $diafaltapedido . "</td>";
                } else {
                    echo "<td class=\"alert-danger\">" . $diafaltapedido . "</td>";
                }
                ?>
                <td><?php echo ($pedido['siglas']); ?></td>
                <td><?php echo ($pedido['estado']); ?></td>
                <td><?php echo ($pedido['unds']); ?></td>
                <td><?php echo ($pedido['usuario']); ?></td>
                <td>
                    <h5>
                        <a class="my-auto" title=" Editar pedido" data-toggle="modal" data-target="#editarPedido"><i class="fas fa-edit a-text-kmisetas my-auto" onclick="formEditarPedido('<?php echo ($datos); ?>')"></i></a>
                        <a class="my-auto" title="Cambiar Procesos" data-toggle="modal" data-target="#editarProceso<?php echo ($pedido['idpedido']); ?>"><i class="fas fa-cut a-text-kmisetas my-auto"></i></a>
                        <a class="my-auto" title="Anular" onclick="confirmarAnuladoPedido('<?php echo ($datos); ?>')" id="anularPedido"><i class="fas fa-minus-circle a-text-kmisetas my-auto"></i></a>
                    </h5>
                </td>
            </tr>
            
        <?php

        endforeach; ?>
    </tbody>
</table>
<!-- MODALES -->
            <!-- modal editar pedido (sin proceso) -->
            <div class="modal fade" id="editarPedido" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
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
                                <form id="formEditarPedido" class="needs-validation mt-4 p-2 " method="POST" novalidate>

                                    <div class="form-group">
                                        <input type="hidden" name="idPedidoEditar" id="idPedidoEditar">
                                        <input type="text" class="form-control input-sm" id="nroPedidoEditar" name="nroPedidoEditar" value="" placeholder="Nro Pedido (*)" autocomplete="off" required>
                                        <!-- <div class="valid-feedback">Listo</div> -->
                                        <div class="invalid-feedback">Ingrese el Nro de Pedido</div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $conexion = new Conexion();
                                        $consultaSQL = "SELECT * FROM clientes order by nombre asc";
                                        $clientes = $conexion->consultarDatos($consultaSQL);
                                        ?>
                                       <input list="clienteEditar" name="clienteEditar"  id="clienteEdit"class="form-control" value="" placeholder="Cliente (*)" autocomplete="off" required></label>
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

                                        <input list="asesorEditar" name="asesor" id="asesorEdit" class="form-control" value="" placeholder="Asesor (*)" autocomplete="off" required></label>
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
                                        <input type="date" class="form-control input-sm" id="inicioEditar" name="inicioEditar" value=""required>
                                        <!-- <div class="valid-feedback">Listo</div> -->
                                        <div class="invalid-feedback">Por Favor Ingrese Fecha</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="finEditar">Fecha Final: (*)</label>
                                        <input type="date" class="form-control input-sm" id="finEditar" name="finEditar" value=""required>
                                        <!-- <div class="valid-feedback">Listo</div> -->
                                        <div class="invalid-feedback">Por Favor Ingrese Fecha</div>
                                    </div>
                                    <div class="form-group">
                                        <label>Días Hábiles</label>
                                        <div  class="form-control input-sm"><span id="diasEditar"></span></div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="undsEditar">Unds: (*)</label>
                                        <input type="number" class="form-control input-sm" value="" id="undsEditar" placeholder="" name="undsEditar" required>
                                        <!-- <div class="valid-feedback">Listo</div> -->
                                        <div class="invalid-feedback">Por Favor Ingrese Fecha</div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="">Procesos (*)</label>
                                        <input type="text" class="form-control input-sm" id="procesosEditar" value="" required readonly>
                                        <!-- <div class="valid-feedback">Listo</div> -->
                                        <div class="invalid-feedback">Por Favor Ingrese Fecha</div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-dismiss="modal" id="modalEditarPedido" onclick="editarPedido();">Editar Pedido</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="salirModal">Cancelar</button>

                        </div>
                    </div>
                </div>



            </div>
            <!-- modal editar pedido (solo proceso) -->
            <div class="modal fade" id="editarProceso<?php echo ($pedido['idpedido']); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title  mx-auto" id="">Editar Proceso</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="salirModal" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-dismiss="modal" id="modalEditarPedido" onclick="editarPedido();">Editar Pedido</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="salirModal">Cancelar</button>

                        </div>
                    </div>
                </div>



            </div>
<!-- datatable -->
<script>
    $(document).ready(function() {
        $('#tablaDinamica').DataTable({

            responsive: true,
            "order": [
                [6, "asc"]
            ],
            "pageLength": 25,
            "language": {
                "url": "./plugins/datatable/Spanish.json"
            },
        });
    });
</script>