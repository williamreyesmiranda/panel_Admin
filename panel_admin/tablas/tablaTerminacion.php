<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../');
}
include("../../db/Conexion.php");
include("../php/funcionFecha.php");
$conexion = new Conexion();
?>
<div class="table-container">
    <table class="table table-hover table-condensed table-bordered tablaDinamica" style="width:1700px !important;" id="" cellspacing="0">
        <thead>
            <tr>
                <th class="alert-info text-center" colspan="6">Info Pedido</th>
                <th class="alert-secondary text-center" colspan="16">Info Terminación</th>
            </tr>
            <tr class="text-center">
                <th class="sticky-top">Pedido</th>
                <th style="z-index:100 !important" class="sticky-left sticky-top">Cliente</th>
                <th class="sticky-top">Fecha Entrega</th>
                <th class="sticky-top">Días Falta</th>
                <th class="sticky-top">Proc</th>
                <th class="sticky-top">Unds</th>
                <th class="sticky-top">Fecha Inicio</th>
                <th class="sticky-top">Fecha Entrega</th>
                <th class="sticky-top">Días Háb</th>
                <th class="sticky-top">Días Falta</th>
                <th class="sticky-top">B</th>
                <th class="sticky-top">Ct</th>
                <th class="sticky-top">Cf</th>
                <th class="sticky-top">S</th>
                <th class="sticky-top">E</th>
                <th class="sticky-top">V</th>
                <th class="sticky-top">Unds Parcial</th>
                <th class="sticky-top">Unds Falta</th>
                <th class="sticky-top">Tiempo (hrs)</th>
                <th class="sticky-top">Observaciones</th>
                <th class="sticky-top">Estado</th>
                <th class="sticky-top">Acciones</th>

            </tr>
        </thead>
        <tfoot>
            <tr class="text-center">
                <th>Pedido</th>
                <th class="mx-auto sticky-left">Cliente</th>
                <th>Fecha Entrega</th>
                <th>Días Falta</th>
                <th>Proc</th>
                <th>Unds</th>
                <th>Fecha Inicio</th>
                <th>Fecha Entrega</th>
                <th>Días Háb</th>
                <th>Días Falta</th>
                <th>B</th>
                <th>Ct</th>
                <th>Cf</th>
                <th>S</th>
                <th>E</th>
                <th>V</th>
                <th>Unds Parcial</th>
                <th>Unds Falta</th>
                <th>Tiempo (hrs)</th>
                <th>Observaciones</th>
                <th>Estado</th>
                <th>Acciones</th>

            </tr>
        </tfoot>
        <tbody>

            <?php



            $consultaSQL = "SELECT pe.idpedido, pe.num_pedido, pe.cliente, pe.asesor, pe.fecha_inicio as 'iniciopedido', 
        pe.fecha_fin as 'finpedido', pe.dias_habiles as 'diaspedido', pe.unds, pe.fecha_ingreso, pe.usuario, pe.estBodega, pe.estCorte, pe.estConfeccion, pe.estEstampacion, pe.estSublimacion, pe.estBordado,
        bo.idterminacion, bo.iniciofecha as 'inicioterminacion', bo.finfecha as 'finterminacion', bo.dias as 'diasterminacion', bo.tiempo,
        bo.inicioprocesofecha, bo.finprocesofecha, bo.parcial, us.usuario, bo.obs_terminacion, bo.numNovedad, pr.siglas, es.estado, est.estado as 'estadopedido'
        FROM pedidos pe 
        
        INNER JOIN procesos pr ON pe.procesos=pr.idproceso
        INNER JOIN terminacion bo ON pe.idpedido=bo.pedido
        INNER JOIN usuario us on pe.usuario=us.idusuario
        INNER JOIN estado es ON bo.estado=es.id_estado
        INNER JOIN estado est ON pe.estado=est.id_estado
        
        WHERE bo.estado<3 ORDER BY bo.finfecha ASC";
            $pedidos = $conexion->consultarDatos($consultaSQL);
            foreach ($pedidos as $pedido) :
                $unds = $pedido['unds'];
                $parcial = $pedido['parcial'];
                $falta = $unds - $parcial;
                $tiempo = round($falta * $pedido['tiempo'] / 60, 2);
                $hoy = date('Y-m-d');
                $diapedido = $pedido['finpedido'];
                $diaterminacion = $pedido['finterminacion'];
                $diafaltapedido =  fechaToDays($hoy, $diapedido) - 1;
                if ($diafaltapedido < 0) {
                    $diafaltapedido =  - (fechaToDays($diapedido, $hoy) - 1);
                }

                $diafaltaterminacion =  fechaToDays($hoy, $diaterminacion) - 1;
                if ($diafaltaterminacion < 0) {
                    $diafaltaterminacion =  - (fechaToDays($diaterminacion, $hoy) - 1);
                }
                //consulta de la novedad por medio del idNovedad
                $numNovedad = $pedido['numNovedad'];
                $consultaSQL = "SELECT * FROM novedades WHERE idNovedad='$numNovedad'";
                $result = $conexion->consultarDatos($consultaSQL);
                $novedad = @$result[0]['novedad'];
                //consulta del nombre del asesor por medio del usuario
                $asesor = $pedido['asesor'];
                $consultaSQL = "SELECT * FROM asesor WHERE usuario='$asesor'";
                $result = $conexion->consultarDatos($consultaSQL);
                $nombreAsesor = @$result[0]['nombre'];
                $correoAsesor = @$result[0]['correo'];
                //consulta correo del cliente
                $cliente = $pedido['cliente'];
                $consultaSQL = "SELECT * FROM clientes WHERE nombre='$cliente'";
                $result = $conexion->consultarDatos($consultaSQL);
                $correoCliente = @$result[0]['correo'];

                $datos = $pedido['idpedido'] . "||" . $pedido['num_pedido'] . "||" . $pedido['cliente'] . "||" . $pedido['asesor'] . "||" . $pedido['iniciopedido'] . "||" .
                    $pedido['finpedido'] . "||" . $pedido['siglas'] . "||" . $pedido['unds'] . "||" . $pedido['diaspedido'] . "||" . $pedido['estadopedido'] . "||" . $pedido['idterminacion'] .
                    "||" . $pedido['obs_terminacion'] . "||" . $pedido['parcial'] . "||" . $pedido['numNovedad'] . "||" . $novedad . "||" . $nombreAsesor . "||" . $correoAsesor . "||" . $correoCliente;


            ?>
                <tr class="text-center">
                    <td><?php echo ($pedido['num_pedido']); ?></td>
                    <td class="mx-auto sticky-left"><a class="a-text-kmisetas" href="" data-toggle="modal" data-target="#verPedido" onclick="verPedido(`'<?php echo ($datos); ?>'`)"><?php echo ($pedido['cliente']); ?></a></td>
                    <td><?php echo ($pedido['finpedido']); ?></td>
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
                    <td><?php echo ($pedido['unds']); ?></td>
                    <td><?php echo ($pedido['inicioterminacion']); ?></td>
                    <td><?php echo ($pedido['finterminacion']); ?></td>
                    <td><?php echo ($pedido['diasterminacion']); ?></td>
                    <?php if ($diafaltaterminacion > 3) {
                        echo "<td class=\"alert-success\">" . $diafaltaterminacion . "</td>";
                    } elseif ($diafaltaterminacion >= 0) {
                        echo "<td class=\"alert-warning\">" . $diafaltaterminacion . "</td>";
                    } else {
                        echo "<td class=\"alert-danger\">" . $diafaltaterminacion . "</td>";
                    } ?>
                    <td><?php echo ($pedido['estBodega']) ?></td>
                    <td><?php echo ($pedido['estCorte']) ?></td>
                    <td><?php echo ($pedido['estConfeccion']) ?></td>
                    <td><?php echo ($pedido['estSublimacion']) ?></td>
                    <td><?php echo ($pedido['estEstampacion']) ?></td>
                    <td><?php echo ($pedido['estBordado']) ?></td>
                    <td><?php echo ($parcial); ?></td>
                    <td><?php echo ($falta); ?></td>
                    <td><?php echo($tiempo);?></td>
                    <td><?php echo ($pedido['obs_terminacion']);
                        if ($pedido['numNovedad'] > 0) {
                            echo ("<br><b>Novedad:</b>" . $novedad);
                        } ?></td>
                    <td><?php echo ($pedido['estado']); ?></td>
                    <td>
                        <a class="my-auto" title="Editar Terminacion" data-toggle="modal" data-target="#editarTerminacion"><i class="fas fa-edit a-text-kmisetas my-auto" onclick="formEditarTerminacion(`<?php echo ($datos); ?>`)"></i></a>
                        <a class="my-auto" title="Reportar Novedad" data-toggle="modal" data-target="#novedadTerminacion"><i class="fas fa-paper-plane a-text-kmisetas my-auto" onclick="formEditarTerminacion(`<?php echo ($datos); ?>`)"></i></a>
                        <a class="my-auto" title="Finalizar" onclick="confirmarFinalizarTerminacion(`<?php echo ($datos); ?>`)" id="finalizarTerminacion"><i class="fas fa-check-circle a-text-kmisetas my-auto"></i></a>
                        <a class="my-auto" title="Anular" onclick="confirmarAnuladoPedido(`<?php echo ($datos); ?>`)" id="anularPedido"><i class="fas fa-minus-circle a-text-kmisetas my-auto"></i></a>
                    </td>
                </tr>

            <?php

            endforeach; ?>
        </tbody>
    </table>
</div>

<!-- <script src="js/scriptsss.js"></script> -->
<!-- datatable -->
<script>
    $(document).ready(function() {

        $('.tablaDinamica').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    /*  pageSize: 'LEGAL' */
                },
                'print'
            ],
            responsive: true,
            "order": [
                [9, "asc"]
            ],
            "pageLength": 25,
            "language": {
                "url": "./plugins/datatable/Spanish.json"
            },
        });

    });
</script>