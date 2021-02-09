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
            <th>Color</th>
            <th>Acciones</th>
        </tr>
    </thead>


    <?php
    $consultaSQL = "SELECT * FROM colores";
    $colores = $conexion->consultarDatos($consultaSQL);
    foreach ($colores as $color) :

        $datos = $color['idColor'] . "||" . $color['nombreColor'];
    ?>
        <tr class="text-center">
            <td><?php echo ($color['idColor']) ?></td>
            <td><?php echo ($color['nombreColor']) ?></td>
            <td>
                <h5>
                    <a class="my-auto" title=" Editar Color" data-toggle="modal" data-target="#editarColor"><i class="fas fa-edit a-text-kmisetas my-auto" onclick="formEditarColores(`'<?php echo ($datos); ?>'`)"></i></a>
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
                [1, "asc"]
            ],
            "pageLength": 25,
            "language": {
                "url": "./plugins/datatable/Spanish.json"
            },
        });
    });
</script>