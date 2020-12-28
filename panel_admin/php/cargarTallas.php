<?php
include("../../db/Conexion.php");
$idTalla = $_POST['idTalla'];
$conexion = new Conexion();
$consulta = "SELECT * FROM tallas WHERE idTalla=$idTalla";
$tallas = $conexion->consultarDatos($consulta);
$max = $tallas[0]['numTallas'];

?>
<div class="form-group col-md-4 mx-auto text-center">
    <label for="idTalla">ID</label>
    <input type="text" name="idTalla" id="idTalla" class="form-control text-center" value="<?php echo ($tallas[0]['idTalla']) ?>" readonly>

</div>
<div class="form-group text-center">
    <button type="button" title="Agregar Filas" class="btn btn-primary mr-2 font-weight-bold" onclick="agregarFilaEditar()"><i class="fas fa-plus-circle "></i></i></button>
    <button type="button" title="Eliminar Filas" class="btn btn-danger font-weight-bold" onclick="eliminarFilaEditar()"><i class="fas fa-minus-circle"></i></button>
</div>
<div class="form-group col-md-5 mx-auto text-center">
    <label for="siglas">Siglas:</label>
    <input type="text" name="siglas" id="siglas" value="<?php echo ($tallas[0]['siglas']) ?>" class="form-control text-center" autocomplete="off">

</div>
<div class="row mx-auto">
    <table border="1" class="table rounded" id="tablaeditarprueba">
        <thead>
            <tr class="bg-dark text-white text-center">
                <th style="width: 50px;">ID</th>
                <th style="width: 100px;">Talla (max 15)</th>

            </tr>
        </thead>
        <tbody>
            <?php for ($i = 1; $i <= $max; $i++) : ?>
                <tr>
                    <td class="text-center"><?php echo ($i) ?></td>
                    <td><input type="text" name="tallas[]" value="<?php echo ($tallas[0][$i]) ?>" class="form-control" autocomplete="off"></td>
                </tr>
            <?php endfor ?>
        </tbody>
    </table>


</div>


<script>
    function agregarFilaEditar() {
        var table = document.getElementById("tablaeditarprueba");
        var rowCount = table.rows.length;
        if (rowCount > 15) {
            Swal.fire({
                position: 'center',
                html: '<br><img src="images/logo_kamisetas.png" alt="" style="width:100px">',
                title: '<br>No se puede ingresar más de 15 filas',
                background: ' #000000cd',
                showConfirmButton: false,
                timer: 2000,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                backdrop: false,
            });
        } else {
            document.getElementById("tablaeditarprueba").insertRow(-1).innerHTML = '<td class="text-center">' + rowCount + '</td><td><input type="text" name="tallas[]" class="form-control" autocomplete="off"></td>';
            /*  console.log(rowCount); */
        }

    }

    function eliminarFilaEditar() {
        var table = document.getElementById("tablaeditarprueba");
        var rowCount = table.rows.length;
        /* console.log(rowCount); */

        if (rowCount <= 1) {
            Swal.fire({
                position: 'center',
                html: '<br><img src="images/logo_kamisetas.png" alt="" style="width:100px">',
                title: '<br>No se puede eliminar el encabezado',
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