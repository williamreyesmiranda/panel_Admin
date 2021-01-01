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
                <th class="alert-secondary text-center" colspan="12">Info Confección</th>
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
                <th class="sticky-top">OC</th>
                <th class="sticky-top">Unds Corte</th>
                <th class="sticky-top">Unds Parcial</th>
                <th class="sticky-top">Unds Falta</th>
                <th class="sticky-top">Entrega Prod</th>
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
                <th>OC</th>
                <th>Unds Corte</th>
                <th>Unds Parcial</th>
                <th>Unds Falta</th>
                <th>Entrega Prod</th>
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
        bo.idconfeccion, bo.iniciofecha as 'inicioconfeccion', bo.finfecha as 'finconfeccion', bo.dias as 'diasconfeccion', bo.entrega,
        bo.inicioprocesofecha, bo.finprocesofecha, bo.parcial, us.usuario, bo.obs_confeccion, bo.numNovedad, pr.siglas, es.estado, est.estado as 'estadopedido'
        FROM pedidos pe 
        
        INNER JOIN procesos pr ON pe.procesos=pr.idproceso
        INNER JOIN confeccion bo ON pe.idpedido=bo.pedido
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
                $diaconfeccion = $pedido['finconfeccion'];
                $diafaltapedido =  fechaToDays($hoy, $diapedido) - 1;
                if ($diafaltapedido < 0) {
                    $diafaltapedido =  - (fechaToDays($diapedido, $hoy) - 1);
                }

                $diafaltaconfeccion =  fechaToDays($hoy, $diaconfeccion) - 1;
                if ($diafaltaconfeccion < 0) {
                    $diafaltaconfeccion =  - (fechaToDays($diaconfeccion, $hoy) - 1);
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
                //consulta de corte para confeccion
                $idPedido=$pedido['idpedido'];
                $consultaSQL="SELECT * FROM corte WHERE pedido='$idPedido'";
                $result=$conexion->consultarDatos($consultaSQL);
                $oc=@$result[0]['oc'];
                $unds_corte=@$result[0]['parcial'];
                if($unds==$unds_corte){
                    $unds_corte="✓";}
                    
                $datos = $pedido['idpedido'] . "||" . $pedido['num_pedido'] . "||" . $pedido['cliente'] . "||" . $pedido['asesor'] . "||" . $pedido['iniciopedido'] . "||" .
                    $pedido['finpedido'] . "||" . $pedido['diaspedido'] . "||" . $pedido['siglas'] . "||" . $pedido['unds'] . "||" . $pedido['estadopedido'] . "||" . $pedido['idconfeccion'] .
                     "||" . $pedido['obs_confeccion'] . "||" . $pedido['parcial']. "||" . $pedido['numNovedad']. "||" .$novedad. "||" .$nombreAsesor. "||" .$correoAsesor. "||" .$pedido['entrega'];


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
                    <td><?php echo ($unds); ?></td>
                    <td><?php echo ($pedido['inicioconfeccion']);?></td>
                    <td><?php echo ($pedido['finconfeccion']);?></td>
                    <td><?php echo ($pedido['diasconfeccion']);?></td>
                    <?php if($diafaltaconfeccion>3){
                        echo "<td class=\"alert-success\">".$diafaltaconfeccion."</td>";
                     }elseif($diafaltaconfeccion>=0){
                         echo "<td class=\"alert-warning\">".$diafaltaconfeccion."</td>";  
                     }else{
                         echo "<td class=\"alert-danger\">".$diafaltaconfeccion."</td>"; 
                     }?>
                     <td><?php echo ($oc);?></td>
                     <td><?php echo ($unds_corte);?></td>
                    <td><?php echo ($parcial);?></td>
                    <td><?php echo ($falta);?></td>
                    <td><?php echo ($pedido['entrega']);?></td>
                    <td><?php echo ($pedido['obs_confeccion']); if($pedido['numNovedad']>0){echo ("<br><b>Novedad:</b>".$novedad);}?></td>
                    <td><?php echo ($pedido['estado']);?></td>
                    <td>
                        <h5>
                            <a class="my-auto" title=" Editar Confeccion" data-toggle="modal" data-target="#editarConfeccion"><i class="fas fa-edit a-text-kmisetas my-auto" onclick="formEditarConfeccion('<?php echo ($datos); ?>')"></i></a>
                            <a class="my-auto" title="Reportar Novedad" data-toggle="modal" data-target="#novedadConfeccion"><i class="fas fa-paper-plane a-text-kmisetas my-auto" onclick="formEditarConfeccion('<?php echo ($datos); ?>')"></i></a>
                            <a class="my-auto" title="Finalizar" onclick="confirmarFinalizarConfeccion('<?php echo ($datos); ?>')" id="finalizarConfeccion"><i class="fas fa-check-circle a-text-kmisetas my-auto"></i></a>
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
                'pdfHtml5',
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