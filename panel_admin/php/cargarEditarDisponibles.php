<?php
include("../../db/Conexion.php");
$idReferencia = $_POST['idReferencia'];
$idColor = $_POST['idColor'];
$conexion = new Conexion();
$consultaSQL = "SELECT * FROM referencias ref INNER JOIN tallas ta ON ref.talla=ta.idTalla WHERE idReferencia=$idReferencia";
$referencias = $conexion->consultarDatos($consultaSQL);
$max = $referencias[0]['numTallas'];

?>
<div class="form-group col-md-12 mx-auto text-center">
    <label for="idTalla" class="font-weight-bold">Referencia:</label><br>
    <input type="hidden" name="idReferencia" id="idReferencia" value="<?php echo ($referencias[0]['idReferencia']) ?>">
    <?php echo ($referencias[0]['codigo'] . ' ' . $referencias[0]['descripcion']) ?>
</div>
<div class="row mx-auto">
    <table border="1" class="table" id="tablaeditarprueba">
        <thead>
            <tr class="bg-dark text-white text-center">
                <th colspan="1"></th>
                <th colspan="<?php echo ($max) ?>" class=" text-center bg-secondary">Disponibles</th>
            </tr>
            <tr class="bg-dark text-white text-center">
                <th style="width: 250px;">Color</th>
                <?php for ($i = 1; $i <= $max; $i++) : ?>
                    <th class=" text-center bg-secondary"><?php echo ($referencias[0][$i]) ?></th>
                <?php endfor ?>
            </tr>
        </thead>
        <tbody>
            <?php $consultaSQL = "SELECT * FROM referencia_color rc INNER JOIN referencias ref ON rc.referencia_color=ref.idReferencia
                                                INNER JOIN colores co ON rc.color_referencia=co.idColor WHERE ref.idReferencia=$idReferencia AND rc.color_referencia=$idColor";
            $ref_colores = $conexion->consultarDatos($consultaSQL);
            

            foreach ($ref_colores as $ref_color) :
                $sumaD = 0;
            ?>
                <tr>
                    <td>
                        <?php
                        $consultaSQL = "SELECT * FROM colores order by nombreColor";
                        $colores = $conexion->consultarDatos($consultaSQL);

                        ?>
                        <input type="hidden" name="idColor" value="<?php echo ($ref_color['color_referencia']) ?>">
                        <input type="text" class="form-control text-center font-weight-bold" value="<?php echo ($ref_color['nombreColor']) ?>" readonly>
                        
                    </td>
                    <?php for ($i = 1; $i <= $max; $i++) : ?>
                        <td><input type="number" name="disponibles[<?php echo ($i) ?>]" value="<?php echo ($ref_color['d' . $i]); ?>" class="form-control" autocomplete="off"></td>
                    <?php $sumaD = $sumaD + $ref_color['s' . $i];
                    endfor; ?>
                </tr>
            <?php 
            endforeach; ?>
        </tbody>
    </table>
</div>