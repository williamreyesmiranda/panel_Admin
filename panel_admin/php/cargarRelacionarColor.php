<?php
include("../../db/Conexion.php");
$idReferencia = $_POST['idReferencia'];
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
<div class="form-group col-md-5 mx-auto text-center">
    <label for="siglas" class="font-weight-bold">Tallas:</label>
    <?php echo ($referencias[0]['siglas']) ?>

</div>
<div class="form-group text-center">
    <button type="button" title="Agregar Filas" class="btn btn-primary mr-2 font-weight-bold" onclick="agregarFilaRelacion('<?php echo ($max) ?>')"><i class="fas fa-plus-circle "></i></i></button>
    <button type="button" title="Eliminar Filas" class="btn btn-danger font-weight-bold" onclick="eliminarFilaRelacion()"><i class="fas fa-minus-circle"></i></button>
</div>

<div class="row mx-auto">
    <table border="1" class="table" id="tablaeditarprueba">
        <thead>
            <tr class="bg-dark text-white text-center">
                <th colspan="2"></th>
                <th colspan="<?php echo ($max) ?>" class=" text-center bg-info">Stock Mínimo</th>
            </tr>
            <tr class="bg-dark text-white text-center">
                <th style="width: 50px;"></th>
                <th style="width: 200px;">Color</th>
                <?php for ($i = 1; $i <= $max; $i++) : ?>
                    <th class=" text-center bg-info"><?php echo ($referencias[0][$i]) ?></th>
                <?php endfor ?>
            </tr>
        </thead>
        <tbody>
            <?php $consultaSQL = "SELECT * FROM referencia_color rc INNER JOIN referencias ref ON rc.referencia_color=ref.idReferencia
                                                INNER JOIN colores co ON rc.color_referencia=co.idColor WHERE ref.idReferencia=$idReferencia";
            $ref_colores = $conexion->consultarDatos($consultaSQL);
            $contar = 1;
            if ($ref_colores) {
                foreach ($ref_colores as $ref_color) :
                    $sumaS = 0;
            ?>
                    <tr>
                        <td class="text-center"><?php echo ($contar) ?></td>
                        <td>
                            <?php
                            $consultaSQL = "SELECT * FROM colores order by nombreColor";
                            $colores = $conexion->consultarDatos($consultaSQL);

                            ?>
                            <select name="colores[]" class="custom-select itemunico select2">
                                <option value="<?php echo ($ref_color['color_referencia']) ?>"><?php echo ($ref_color['nombreColor']) ?></option>
                                <?php foreach ($colores as $color) : ?>
                                    <option value="<?php echo ($color['idColor']) ?>"><?php echo ($color['nombreColor']) ?></option>
                                <?php endforeach ?>
                            </select>

                        </td>
                        <?php for ($i = 1; $i <= $max; $i++) : ?>
                            <td><input type="number" name="stock[<?php echo ($contar) ?>][<?php echo ($i) ?>]" value="<?php echo ($ref_color['s' . $i]); ?>" class="form-control" autocomplete="off"></td>
                        <?php $sumaS = $sumaS + $ref_color['s' . $i];
                        endfor; ?>
                    </tr>
                <?php $contar++;
                endforeach;
            } else { ?>
                <tr>
                    <td class="text-center"><?php echo ($contar) ?></td>
                    <td>
                        <?php
                        $consultaSQL = "SELECT * FROM colores order by nombreColor";
                        $colores = $conexion->consultarDatos($consultaSQL);

                        ?>
                        <select name="colores[]" class="custom-select select2">
                            <option value="" disabled selected>Seleccione una Opción</option>
                            <?php foreach ($colores as $color) : ?>
                                <option value="<?php echo ($color['idColor']) ?>"><?php echo ($color['nombreColor']) ?></option>
                            <?php endforeach ?>
                        </select>

                    </td>
                    <?php for ($i = 1; $i <= $max; $i++) : ?>
                        <td><input type="number" name="stock[<?php echo ($contar) ?>][<?php echo ($i) ?>]" value="0" class="form-control" autocomplete="off"></td>
                    <?php
                    endfor; ?>
                </tr> <?php } ?>
        </tbody>
    </table>



</div>


<script>
    function agregarFilaRelacion(datos) {
        max = datos;
        var td = '';
        var table = document.getElementById("tablaeditarprueba");
        var rowCount = table.rows.length - 1;
        for (var i = 1; i <= max; i++) {
            td = td + "<td><input type=\"number\" name=\"stock[" + rowCount + "][" + i + "]\" class=\"form-control\" autocomplete=\"off\" value=\"0\"></td>";
        }
        var select = "<select name=\"colores[]\" class=\"custom-select select2\"><option value=\"\" selected disabled>Seleccione una Opción</option><?php foreach ($colores as $color) : ?><option value=\"<?php echo ($color["idColor"]) ?>\"><?php echo ($color['nombreColor']) ?></option><?php endforeach ?></select>";

        document.getElementById("tablaeditarprueba").insertRow(-1).innerHTML = '<td class="text-center">' + rowCount + '</td><td>' + select + '</td>' + td;
    }

    function eliminarFilaRelacion() {
        var table = document.getElementById("tablaeditarprueba");
        var rowCount = table.rows.length;
        /* console.log(rowCount); */

        if (rowCount <= 2) {
            Swal.fire({
                position: 'center',
                html: '<br><img src="images/logo_kamisetas.png" alt="" style="width:100px">',
                title: '<br>No se puede eliminar el Encabezado',
                background: ' #000000cd',
                showConfirmButton: false,
                timer: 2000,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                backdrop: false,
            });
        } else {
            table.deleteRow(rowCount - 1);
        }
    }

   
</script>