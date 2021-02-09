<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../');
}
?>
<table class="table table-hover table-condensed table-bordered tablaDinamica" id="" width="100%" cellspacing="0">
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
            <th>Valor</th>
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
            <th>Valor</th>
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
                $pedido['fecha_fin'] . "||" . $pedido['siglas'] . "||" . $pedido['unds'] . "||" . $pedido['dias_habiles'] . "||" . $pedido['idproceso']. "||" . $pedido['valor'];


        ?>
            <tr class="text-center">
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
                <td><?php echo ('$'.number_format($pedido['valor'])); ?></td>
                <td><?php echo ($pedido['usuario']); ?></td>
                <td>
                    <h5><?php if ($_SESSION['user'] == $pedido['usuario'] || $_SESSION['idrol'] == 1) : ?>
                            <a class="my-auto" title=" Editar pedido" data-toggle="modal" data-target="#editarPedido"><i class="fas fa-edit a-text-kmisetas my-auto" onclick="formEditarPedido(`'<?php echo ($datos); ?>'`)"></i></a>
                            <a class="my-auto" title="Cambiar Procesos" data-toggle="modal" data-target="#editarProceso"><i class="far fa-paper-plane a-text-kmisetas my-auto" onclick="formEditarPedido(`'<?php echo ($datos); ?>'`)"></i></a>
                            <a class="my-auto" title="Anular" onclick="confirmarAnuladoPedido(`'<?php echo ($datos); ?>'`)" id="anularPedido"><i class="fas fa-minus-circle a-text-kmisetas my-auto"></i></a>
                        <?php endif; ?>
                    </h5>
                </td>
            </tr>

        <?php

        endforeach; ?>
    </tbody>
</table>
<!-- <script src="js/scriptsss.js"></script> -->
<!-- datatable -->
<script>
    $(document).ready(function() {

        $('.tablaDinamica').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'pdfHtml5',
                'print'
            ],
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