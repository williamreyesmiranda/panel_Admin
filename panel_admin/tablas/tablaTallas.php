<!-- <div id="contenedor_carga" >
                    <div id="carga"></div> -->
<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../');
}
include("../../db/Conexion.php");

$conexion = new Conexion();
$consultaSQL = "SELECT max(numTallas) as 'max' FROM tallas";
$tallas = $conexion->consultarDatos($consultaSQL);
$max = $tallas[0]['max'];

?>
<table class="table table-hover table-condensed table-bordered" id="tablaTallas" width="100%" cellspacing="0">
    <thead class="thead-dark">
        <tr class="text-center">
            <th>ID</th>
            <th>Siglas</th>
            <?php for ($i = 1; $i <= $max; $i++) : ?>
                <th><?php echo $i; ?></th>
            <?php endfor; ?>
            <th>Acciones</th>
        </tr>
    </thead>


        <?php
        $consultaSQL = "SELECT * FROM tallas";
        $tallas = $conexion->consultarDatos($consultaSQL);
        foreach ($tallas as $talla) :

            $datos=$talla['idTalla'];
        ?>
        
            <tr class="text-center">
                <td><?php echo ($talla['idTalla']) ?></td>
                <td><?php echo ($talla['siglas']) ?></td>

                <?php for ($i = 1; $i <= $max; $i++) : ?>
                    <td><?php echo ($talla[$i]); ?></td>
                <?php endfor; ?>

                <td>
                    <h5>
                        <a class="my-auto" title=" Editar Tallas" data-toggle="modal" data-target="#editarTallas"><i class="fas fa-edit a-text-kmisetas my-auto" onclick="formEditarTallas(`'<?php echo ($datos); ?>'`)"></i></a>
                    </h5>
                </td>
               
            </tr>
            
             
        <?php
        
        endforeach;  ?>
    </table>   


<!-- datatable -->
<script>
    $(document).ready(function() {

        $('#tablaTallas').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'pdfHtml5',
                'print'
            ],
            responsive: true,
            "order": [
                [0, "asc"]
            ],
            "pageLength": 25,
            "language": {
                "url": "./plugins/datatable/Spanish.json"
            },
        });
    });
</script>