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

        $datos = $referencia['idReferencia'] . "||" . $referencia['codigo'] . "||" . $referencia['descripcion'] . "||" . $referencia['correo'];

    ?>
        <div class="card mb-3">
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
                            Lista de <?php echo ($referencia['codigo']); ?>
                            <a href="#" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#ingresarColor">Ingresar</a>
                        </div>
                        <div class="card-body ">
                            <?php
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

                                    $datos = $talla['idTalla'];
                                ?>

                                    <tr class="text-center">
                                        <td><?php echo ($talla['idTalla']) ?></td>
                                        <td><?php echo ($talla['siglas']) ?></td>

                                        <?php for ($i = 1; $i <= $max; $i++) : ?>
                                            <td><?php echo ($talla[$i]); ?></td>
                                        <?php endfor; ?>

                                        <td>
                                            <h5>
                                                <a class="my-auto" title=" Editar Tallas" data-toggle="modal" data-target="#editarTallas"><i class="fas fa-edit a-text-kmisetas my-auto" onclick="formEditarTallas('<?php echo ($datos); ?>')"></i></a>
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