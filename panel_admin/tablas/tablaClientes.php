<style>

</style>

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
            <th>Doc</th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Asesor</th>
            <th>Celular</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tfoot>
        <tr class="text-center">
            <th>ID</th>
            <th>Doc</th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Asesor</th>
            <th>Celular</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </tfoot>
    <tbody>

        <?php include("../../db/Conexion.php");
        include("../php/funcionFecha.php");


        $conexion = new Conexion();
        $consultaSQL = "SELECT * FROM clientes order by nombre asc";
        $clientes = $conexion->consultarDatos($consultaSQL);
        foreach ($clientes as $cliente) :
            $datos = $cliente['id_cliente'] . "||" . $cliente['documento'] . "||" . $cliente['nombre'] .
                "||" . $cliente['direccion'] . "||" . $cliente['asesor'] . "||" . $cliente['celular'] . "||" . $cliente['correo'];


        ?>
            <tr class="text-center">
                <td><?php echo ($cliente['id_cliente']); ?></td>
                <td><?php echo ($cliente['documento']); ?></td>
                <td><?php echo ($cliente['nombre']); ?></td>
                <td><?php echo ($cliente['direccion']); ?></td>
                <td><?php echo ($cliente['asesor']); ?></td>
                <td><?php echo ($cliente['celular']); ?></td>
                <td><?php echo ($cliente['correo']); ?></td>
                <td>
                    <h5>
                        <a class="my-auto" title=" Editar Cliente" data-toggle="modal" data-target="#editarCliente"><i class="fas fa-edit a-text-kmisetas my-auto" onclick="formEditarCliente('<?php echo ($datos); ?>')"></i></a>
                    </h5>
                </td>
            </tr>

        <?php
$fin=1;
        endforeach;  ?>
        
    </tbody>
</table>
<script src="js/scriptss.js"></script>
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
                [2, "asc"]
            ],
            "pageLength": 25,
            "language": {
                "url": "./plugins/datatable/Spanish.json"
            },
        });
    });
</script>
