<!-- <div id="contenedor_carga" >
                    <div id="carga"></div> -->
<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../');
}
include("../../db/Conexion.php");
$conexion = new Conexion();
?>
<table class="table table-hover table-condensed table-bordered" id="tablaReferencias" width="100%" cellspacing="0">
    <thead class="thead-dark">
        <tr class="text-center">
            <th>ID</th>
            <th>Código</th>
            <th>Descripción</th>
            <th>Tallas</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>


    <?php
    $consultaSQL = "SELECT * FROM referencias INNER JOIN tallas ON referencias.talla=tallas.idTalla";
    $referencias = $conexion->consultarDatos($consultaSQL);
    foreach ($referencias as $referencia) :

        $datos = $referencia['idReferencia']."||".$referencia['codigo']."||".$referencia['descripcion']."||".$referencia['correo']."||".$referencia['talla'];
   ?>

        <tr class="text-center">
            <td><?php echo ($referencia['idReferencia']) ?></td>
            <td><?php echo ($referencia['codigo']) ?></td>
            <td class="text-capitalize"><?php echo ($referencia['descripcion']) ?></td>
            <td><?php echo ($referencia['siglas']) ?></td>
            <td><?php echo ($referencia['correo']) ?></td>
            <td>
                <h5>
                    <a class="my-auto" title=" Editar Referencia" data-toggle="modal" data-target="#editarReferencias"><i class="fas fa-edit a-text-kmisetas my-auto" onclick="formEditarReferencias(`'<?php echo ($datos); ?>'`)"></i></a>
                </h5>
            </td>

        </tr>


    <?php

    endforeach;  ?>
</table>


<!-- datatable -->
<script>
    $(document).ready(function() {

        $('#tablaReferencias').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'pdfHtml5',
                'print'
            ],
            responsive: true,
            "order": [
                [2, "asc"]
            ],
            "pageLength": 25,
            "language": {
                "url": "./plugins/datatable/Spanish.json"
            },
        });
    });
</script>