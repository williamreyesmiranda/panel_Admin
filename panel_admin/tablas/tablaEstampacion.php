<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../');
}
?>
<div class="table-container">
    <table class="table table-hover table-condensed table-bordered tablaDinamica" id="" cellspacing="0">

        <thead>
            <tr>
                <th class="alert-info text-center" colspan="6">Info Pedido</th>
                <th class="alert-secondary text-center" colspan="27">Info Estampación</th>
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
                <th class="sticky-top">P</th>
                <th class="sticky-top">AD</th>
                <th class="sticky-top">AI</th>
                <th class="sticky-top">G</th>
                <th class="sticky-top">E</th>
                <th class="sticky-top">S</th>
                <th class="sticky-top">N° Diseño</th>
                <th class="sticky-top">Pos</th>
                <th class="sticky-top">Técnica</th>
                <th class="sticky-top">Seda</th>
                <th class="sticky-top">N° Plancha</th>
                <th class="sticky-top">Fte</th>
                <th class="sticky-top">Esp</th>
                <th class="sticky-top">Otr</th>
                <th class="sticky-top">Prep (min)</th>
                <th class="sticky-top">Est (min)</th>
                <th class="sticky-top">Sub (min)</th>
                <th class="sticky-top">Tiempo (hrs)</th>
                <th class="sticky-top">Unds Parcial</th>
                <th class="sticky-top">Unds Falta</th>
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
                <th>P</th>
                <th>AD</th>
                <th>AI</th>
                <th>G</th>
                <th>E</th>
                <th>S</th>
                <th>Técnica</th>
                <th>N° Diseño</th>
                <th>Pos</th>
                <th>Seda</th>
                <th>N° Plancha</th>
                <th>Fte</th>
                <th>Esp</th>
                <th>Otr</th>
                <th>Prep (min)</th>
                <th>Est (min)</th>
                <th>Sub (min)</th>
                <th>Tiempo (hrs)</th>
                <th>Unds Parcial</th>
                <th>Unds Falta</th>
                <th>Observaciones</th>
                <th>Estado</th>
                <th>Acciones</th>

            </tr>
        </tfoot>
        <tbody>

            <?php include("../../db/Conexion.php");
            include("../php/funcionFecha.php");


            $conexion = new Conexion();
            $consultaSQL = "SELECT pe.idpedido, pe.num_pedido, pe.cliente, pe.asesor, pe.fecha_inicio as 'iniciopedido', 
        pe.fecha_fin as 'finpedido', pe.dias_habiles as 'diaspedido', pe.unds, pe.fecha_ingreso, pe.usuario,
        bo.idestampacion, bo.iniciofecha as 'inicioestampacion', bo.finfecha as 'finestampacion', bo.dias as 'diasestampacion',
        bo.inicioprocesofecha, bo.finprocesofecha, bo.parcial, us.usuario, bo.obs_estampacion, bo.numNovedad, 
        bo.arte_diseno, bo.arte_impresion, bo.estampacion, bo.sublimacion, bo.grabacion, bo.tecnica, bo.nro_diseno, bo.posicion, bo.seda, bo.nro_plancha,
        bo.fren, bo.esp, bo.otro, bo.prep, bo.est, bo.sub, pr.siglas, es.estado, est.estado as 'estadopedido'
        FROM pedidos pe 
        
        INNER JOIN procesos pr ON pe.procesos=pr.idproceso
        INNER JOIN estampacion bo ON pe.idpedido=bo.pedido
        INNER JOIN usuario us on pe.usuario=us.idusuario
        INNER JOIN estado es ON bo.estado=es.id_estado
        INNER JOIN estado est ON pe.estado=est.id_estado
        
        WHERE bo.estado<3";
            $pedidos = $conexion->consultarDatos($consultaSQL);
            foreach ($pedidos as $pedido) :
                $idPedido = $pedido['idpedido'];
                $unds = $pedido['unds'];
                $parcial = $pedido['parcial'];
                $falta = $unds - $parcial;
                $hoy = date('Y-m-d');
                $diapedido = $pedido['finpedido'];
                $diaestampacion = $pedido['finestampacion'];
                $diafaltapedido =  fechaToDays($hoy, $diapedido) - 1;
                if ($diafaltapedido < 0) {
                    $diafaltapedido =  - (fechaToDays($diapedido, $hoy) - 1);
                }

                $diafaltaestampacion =  fechaToDays($hoy, $diaestampacion) - 1;
                if ($diafaltaestampacion < 0) {
                    $diafaltaestampacion =  - (fechaToDays($diaestampacion, $hoy) - 1);
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
                //consultar el producto de bodega y confeccion
                $consultaSQL = "SELECT * FROM confeccion WHERE pedido='$idPedido'";
                $result = $conexion->consultarDatos($consultaSQL);
                $prodConfeccion = @$result[0]['entrega'];
                $consultaSQL = "SELECT * FROM bodega WHERE pedido='$idPedido'";
                $result = $conexion->consultarDatos($consultaSQL);
                $prodBodega = @$result[0]['entrega'];

                $datos = $pedido['idpedido'] . "||" . $pedido['num_pedido'] . "||" . $pedido['cliente'] . "||" . $pedido['asesor'] . "||" . $pedido['iniciopedido'] . "||" .
                    $pedido['finpedido'] . "||" . $pedido['diaspedido'] . "||" . $pedido['siglas'] . "||" . $pedido['unds'] . "||" . $pedido['estadopedido'] . "||" . $pedido['idestampacion'] .
                    "||" . $pedido['obs_estampacion'] . "||" . $pedido['parcial'] . "||" . $pedido['numNovedad'] . "||" . $novedad . "||" . $nombreAsesor . "||" . $correoAsesor . "||" . $pedido['arte_diseno'] .
                    "||" . $pedido['grabacion'] . "||" . $pedido['estampacion'] . "||" . $pedido['sublimacion'] . "||" . $pedido['tecnica'] . "||" . $pedido['nro_diseno'] .
                    "||" . $pedido['posicion'] . "||" . $pedido['seda'] . "||" . $pedido['nro_plancha'] . "||" . $pedido['fren'] . "||" . $pedido['esp'] . "||" . $pedido['otro'] .
                    "||" . $pedido['prep'] . "||" . $pedido['est'] . "||" . $pedido['sub'] . "||" . $pedido['arte_impresion'];


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
                    <td><?php echo ($pedido['inicioestampacion']); ?></td>
                    <td class="alert-info"><?php echo ($pedido['finestampacion']); ?></td>
                    <td><?php echo ($pedido['diasestampacion']); ?></td>
                    <?php if ($diafaltaestampacion > 3) {
                        echo "<td class=\"alert-success\">" . $diafaltaestampacion . "</td>";
                    } elseif ($diafaltaestampacion >= 0) {
                        echo "<td class=\"alert-warning\">" . $diafaltaestampacion . "</td>";
                    } else {
                        echo "<td class=\"alert-danger\">" . $diafaltaestampacion . "</td>";
                    } ?>
                    <td><?php echo ($prodConfeccion . $prodBodega); ?></td>
                    <td><?php echo ($pedido['arte_diseno']); ?></td>
                    <td><?php echo ($pedido['arte_impresion']); ?></td>
                    <td><?php echo ($pedido['grabacion']); ?></td>
                    <td><?php echo ($pedido['estampacion']); ?></td>
                    <td><?php echo ($pedido['sublimacion']); ?></td>
                    <td><?php echo ($pedido['nro_diseno']); ?></td>
                    <td><?php echo ($pedido['posicion']); ?></td>
                    <td><?php echo ($pedido['tecnica']); ?></td>
                    <td><?php echo ($pedido['seda']); ?></td>
                    <td><?php echo ($pedido['nro_plancha']); ?></td>
                    <td><?php echo ($pedido['fren']); ?></td>
                    <td><?php echo ($pedido['esp']); ?></td>
                    <td><?php echo ($pedido['otro']); ?></td>
                    <td><?php echo ($pedido['prep']); ?></td>
                    <td><?php echo ($pedido['est']); ?></td>
                    <td><?php echo ($pedido['sub']); ?></td>
                    <td><?php echo round(($pedido['sub'] + $pedido['est'] + $pedido['prep']) * $falta / $unds / 60, 2); ?></td>
                    <td><?php echo ($parcial); ?></td>
                    <td><?php echo ($falta); ?></td>
                    <td><?php echo ($pedido['obs_estampacion']);
                        if ($pedido['numNovedad'] > 0) {
                            echo ("<br><b>Novedad:</b>" . $novedad);
                        } ?></td>
                    <td><?php echo ($pedido['estado']); ?></td>
                    <td>
                        <h5>
                            <a class="my-auto" title=" Editar Estampacion" data-toggle="modal" data-target="#editarEstampacion"><i class="fas fa-edit a-text-kmisetas my-auto" onclick="formEditarEstampacion(`'<?php echo ($datos); ?>'`)"></i></a>
                            <a class="my-auto" title="Reportar Novedad" data-toggle="modal" data-target="#novedadEstampacion"><i class="fas fa-paper-plane a-text-kmisetas my-auto" onclick="formEditarEstampacion(`'<?php echo ($datos); ?>'`)"></i></a>
                            <a class="my-auto" title="Finalizar" onclick="confirmarFinalizarEstampacion(`'<?php echo ($datos); ?>'`)" id="finalizarEstampacion"><i class="fas fa-check-circle a-text-kmisetas my-auto"></i></a>
                        </h5>
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
                    pageSize: 'LEGAL'
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