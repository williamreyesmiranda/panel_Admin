<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../');
}
include("../../db/Conexion.php");
$conexion = new Conexion();


$consultaSQL = "SELECT * FROM referencias order by codigo";
$referencias = $conexion->consultarDatos($consultaSQL);
$contar = 1;
?>
<div class="accordion" id="accordionExample">


    <?php foreach ($referencias as $referencia) :
        $idReferencia = $referencia['idReferencia'];
        $consultaSQL = "SELECT * FROM referencias ref INNER JOIN tallas ta ON ref.talla=ta.idTalla WHERE idReferencia=$idReferencia";
        $ref_tallas = $conexion->consultarDatos($consultaSQL);
        $max = $ref_tallas[0]['numTallas'];

        $datos = $referencia['idReferencia'];
    ?>
        <div class="card ">
            <a href="#collapse<?php echo ($contar) ?>" class="btn btn-link text-decoration-none text-dark" type="button" data-toggle="collapse" data-target="#collapse<?php echo ($contar) ?>" aria-expanded="true" aria-controls="collapse<?php echo ($contar) ?>">
                <div class="card-header alert-dark" id="headingOne">
                    <h2 class="mb-0 text-left text-capitalize">
                        <?php echo ($referencia['codigo'] . " " . $referencia['descripcion']) ?>
                    </h2>
                </div>
            </a>

            <div id="collapse<?php echo ($contar) ?>" class="collapse show" aria-labelledby="heading<?php echo ($contar) ?>" data-parent="">
                <div class="card-body">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center p-1">
                            .
                            <a href="#" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#relacionarColor" onclick="formRelacionarColor('<?php echo ($datos); ?>')">Relacionar Colores y Stock Mínimo</a>
                        </div>
                        <div class="card-body ">
                            <?php

                            ?>
                            <table class="table table-hover table-condensed table-bordered tablaDinamica">
                                <thead class="thead-dark">

                                    <tr>
                                        <th class=" text-center bg-dark" colspan="2">INFO REF</th>
                                        <th class=" text-center bg-info" colspan="<?php echo ($max + 1) ?>">STOCK MINIMO</th>
                                        <th class="text-center bg-secondary" colspan="<?php echo ($max + 1) ?>">DISPONIBLES</th>
                                        <th class="text-center bg-danger" colspan="<?php echo ($max + 1) ?>">X PROGRAMAR</th>
                                        <th></th>
                                    </tr>
                                    <tr class="text-center">
                                        <th>Referencia</th>
                                        <th>Color</th>
                                        <?php for ($i = 1; $i <= $max; $i++) : ?>
                                            <th class=" text-center bg-info"><?php echo $ref_tallas[0][$i]; ?></th>
                                        <?php endfor; ?>
                                        <th class=" text-center bg-info">Total</th>
                                        <?php for ($i = 1; $i <= $max; $i++) : ?>
                                            <th class="text-center bg-secondary"><?php echo $ref_tallas[0][$i]; ?></th>
                                        <?php endfor; ?>
                                        <th class="text-center bg-secondary">Total</th>
                                        <?php for ($i = 1; $i <= $max; $i++) : ?>
                                            <th class="text-center bg-danger"><?php echo $ref_tallas[0][$i]; ?></th>
                                        <?php endfor; ?>
                                        <th class="text-center bg-danger">Total</th>
                                        <th class="text-center bg-secondary">Acc</th>
                                    </tr>
                                </thead>


                                <?php
                                $consultaSQL = "SELECT * FROM referencia_color rc INNER JOIN referencias ref ON rc.referencia_color=ref.idReferencia
                                                INNER JOIN colores co ON rc.color_referencia=co.idColor WHERE ref.idReferencia=$idReferencia";
                                $ref_colores = $conexion->consultarDatos($consultaSQL);
                                foreach ($ref_colores as $ref_color) :

                                    $datos = $ref_color['referencia_color'] . '||' . $ref_color['color_referencia'];
                                    $sumaS = 0; //Suma Stock
                                    $sumaD = 0; //Suma disponible
                                    $sumaP = 0; //suma pendiente por programar
                                ?>

                                    <tr class="text-center">
                                        <td><?php echo ($ref_color['codigo'] . ' ' . $ref_color['descripcion']) ?></td>
                                        <td><?php echo ($ref_color['nombreColor']) ?></td>

                                        <?php for ($i = 1; $i <= $max; $i++) : ?>

                                            <td><?php echo ($ref_color['s' . $i]);
                                                $sumaS = $sumaS + $ref_color['s' . $i] ?></td>
                                        <?php endfor; ?>
                                        <td><?php echo ($sumaS) ?></td>
                                        <?php for ($i = 1; $i <= $max; $i++) : ?>

                                            <td><?php echo ($ref_color['d' . $i]);
                                                $sumaD = $sumaD + $ref_color['d' . $i] ?></td>
                                        <?php endfor; ?>
                                        <td><?php echo ($sumaD) ?></td>

                                        <?php for ($i = 1; $i <= $max; $i++) : ?>

                                            <td><?php $suma = $ref_color['s' . $i] - $ref_color['d' . $i];
                                                if ($suma < 0) {
                                                    echo 0;
                                                } else {
                                                    $sumaP = $sumaP + $suma;
                                                    echo ($suma);
                                                }
                                                ?></td>
                                        <?php endfor; ?>
                                        <td><?php echo ($sumaP) ?></td>
                                        <td>
                                            <h5>
                                                <a class="my-auto a-text-kmisetas" title="Editar Disponibles" data-toggle="modal" data-target="#relacionarDisponible" onclick="formEditarDisponible('<?php echo ($datos); ?>')"><i class="fas fa-edit a-text-kmisetas my-auto"></i></a>
                                            </h5>
                                        </td>

                                    </tr>


                                <?php

                                endforeach;  ?>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    <?php $contar++;;
    endforeach ?>
</div>

<!-- modal editar disponible -->
<div class="modal fade" id="relacionarDisponible" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <h2 class="modal-title mx-auto">Editar Unidades Disponibles</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="salirModal" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <div class=" mx-auto d-block border border-dark rounded col-md-12">
                    <form id="formEditarDisponible" class="needs-validation p-2 " method="POST" novalidate>
                        <div class="cargaDisponible">
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal" id="" onclick="editarDisponible()">Relacionar</button>
                <button type="button" class="btn btn-danger salirModal" data-dismiss="modal" id="salirModal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

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
                [1, "asc"]
            ],
            "pageLength": 25,
            "language": {
                "url": "./plugins/datatable/Spanish.json"
            },
        });

    });
</script>