<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../');
}
?>
<div class="table-container">
    <table class="table table-hover table-condensed table-bordered tablaDinamica" style="width:1700px !important;"id="" cellspacing="0">
        <thead>
            <tr>
                <th class="alert-info text-center" colspan="6">Info Pedido</th>
                <th class="alert-secondary text-center" colspan="9">Info Bodega</th>
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
        bo.idbodega, bo.iniciofecha as 'iniciobodega', bo.finfecha as 'finbodega', bo.dias as 'diasbodega',
        bo.inicioprocesofecha, bo.finprocesofecha, bo.parcial, us.usuario, bo.obs_bodega, bo.numNovedad, pr.siglas, es.estado, est.estado as 'estadopedido'
        FROM pedidos pe 
        
        INNER JOIN procesos pr ON pe.procesos=pr.idproceso
        INNER JOIN bodega bo ON pe.idpedido=bo.pedido
        INNER JOIN usuario us on pe.usuario=us.idusuario
        INNER JOIN estado es ON bo.estado=es.id_estado
        INNER JOIN estado est ON pe.estado=est.id_estado
        
        WHERE bo.estado<3";
            $pedidos = $conexion->consultarDatos($consultaSQL);
            foreach ($pedidos as $pedido) :
                $unds = $pedido['unds'];
                $parcial = $pedido['parcial'];
                $falta = $unds - $parcial;
                $hoy = date('Y-m-d');
                $diapedido = $pedido['finpedido'];
                $diabodega = $pedido['finbodega'];
                $diafaltapedido =  fechaToDays($hoy, $diapedido) - 1;
                if ($diafaltapedido < 0) {
                    $diafaltapedido =  - (fechaToDays($diapedido, $hoy) - 1);
                }

                $diafaltabodega =  fechaToDays($hoy, $diabodega) - 1;
                if ($diafaltabodega < 0) {
                    $diafaltabodega =  - (fechaToDays($diabodega, $hoy) - 1);
                }
                //consulta de la novedad por medio del idNovedad
                $numNovedad=$pedido['numNovedad'];
                $consultaSQL="SELECT * FROM novedades WHERE idNovedad='$numNovedad'";
                $result=$conexion->consultarDatos($consultaSQL);
                $novedad=@$result[0]['novedad'];
                //consulta del nombre del asesor por medio del usuario
                $asesor=$pedido['asesor'];
                $consultaSQL="SELECT * FROM asesor WHERE usuario='$asesor'";
                $result=$conexion->consultarDatos($consultaSQL);
                $nombreAsesor=@$result[0]['nombre'];
                $correoAsesor=@$result[0]['correo'];

                $datos = $pedido['idpedido'] . "||" . $pedido['num_pedido'] . "||" . $pedido['cliente'] . "||" . $pedido['asesor'] . "||" . $pedido['iniciopedido'] . "||" .
                    $pedido['finpedido'] . "||" . $pedido['diaspedido'] . "||" . $pedido['siglas'] . "||" . $pedido['unds'] . "||" . $pedido['estadopedido'] . "||" . $pedido['idbodega'] .
                     "||" . $pedido['obs_bodega'] . "||" . $pedido['parcial']. "||" . $pedido['numNovedad']. "||" .$novedad. "||" .$nombreAsesor. "||" .$correoAsesor;


            ?>
                <tr class="text-center">
                    <td><?php echo ($pedido['num_pedido']); ?></td>
                    <td class="mx-auto sticky-left"><a class="a-text-kmisetas" href="" data-toggle="modal" data-target="#verPedido" onclick="verPedido('<?php echo ($datos); ?>')"><?php echo ($pedido['cliente']); ?></a></td>
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
                    <td><?php echo ($pedido['iniciobodega']);?></td>
                    <td><?php echo ($pedido['finbodega']);?></td>
                    <td><?php echo ($pedido['diasbodega']);?></td>
                    <?php if($diafaltabodega>3){
                        echo "<td class=\"alert-success\">".$diafaltabodega."</td>";
                     }elseif($diafaltabodega>=0){
                         echo "<td class=\"alert-warning\">".$diafaltabodega."</td>";  
                     }else{
                         echo "<td class=\"alert-danger\">".$diafaltabodega."</td>"; 
                     }?>
                    <td><?php echo ($parcial);?></td>
                    <td><?php echo ($falta);?></td>
                    <td><?php echo ($pedido['obs_bodega']); if($pedido['numNovedad']>0){echo ("<br><b>Novedad:</b>".$novedad);}?></td>
                    <td><?php echo ($pedido['estado']);?></td>
                    <td>
                        <h5>
                            <a class="my-auto" title=" Editar Bodega" data-toggle="modal" data-target="#editarBodega"><i class="fas fa-edit a-text-kmisetas my-auto" onclick="formEditarBodega('<?php echo ($datos); ?>')"></i></a>
                            <a class="my-auto" title="Reportar Novedad" data-toggle="modal" data-target="#novedadBodega"><i class="fas fa-paper-plane a-text-kmisetas my-auto" onclick="formEditarBodega('<?php echo ($datos); ?>')"></i></a>
                            <a class="my-auto" title="Finalizar" onclick="confirmarFinalizarBodega('<?php echo ($datos); ?>')" id="finalizarBodega"><i class="fas fa-check-circle a-text-kmisetas my-auto"></i></a>
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
                'pdfHtml5'
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