
<!-- <div id="contenedor_carga" >
                    <div id="carga"></div> -->
<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../');
}
?>
<table class="table table-hover table-condensed table-bordered tablaClientes" id="" width="100%" cellspacing="0">
    <thead>
        <tr class="text-center">
            <th>ID</th>
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Correo</th>
            <th>Celular</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tfoot>
        <tr class="text-center">
            <th>ID</th>
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Correo</th>
            <th>Celular</th>
            <th>Acciones</th>
        </tr>
        </tr>
    </tfoot>
    <tbody>

        <?php include("../../db/Conexion.php");
        include("../php/funcionFecha.php");


        $conexion = new Conexion();
        $consultaSQL = "SELECT * FROM asesor";
        $asesores = $conexion->consultarDatos($consultaSQL);
        foreach ($asesores as $asesor) :
            $datos = $asesor['idasesor'] . "||" . $asesor['nombre'] . "||" . $asesor['usuario'] .
                "||" . $asesor['correo'] . "||" . $asesor['celular'] ;


        ?>
        <tr class="text-center">
            <td><?php echo ($asesor['idasesor']); ?></td>
            <td><?php echo ($asesor['nombre']); ?></td>
            <td><?php echo ($asesor['usuario']); ?></td>
            <td><?php echo ($asesor['correo']); ?></td>
            <td><?php echo ($asesor['celular']); ?></td>
            <td>
                <h5>
                    <a class="my-auto" title=" Editar Asesor" data-toggle="modal" data-target="#editarAsesor"><i
                            class="fas fa-edit a-text-kmisetas my-auto"
                            onclick="formEditarAsesor(`'<?php echo ($datos); ?>'`)"></i></a>
                </h5>
            </td>
        </tr>

        <?php

        endforeach;  ?>

    </tbody>
</table>
<!-- <script src="js/scri.js"></script> -->
<!-- datatable -->
<script>
$(document).ready(function() {

    $('.tablaClientes').DataTable({
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