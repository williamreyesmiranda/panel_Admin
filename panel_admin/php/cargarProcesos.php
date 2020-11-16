<?php
include("funcionFecha.php");
$fechaInicio = $_POST['fechaInicio'];
$fechaFin = $_POST['fechaFin'];
$idProceso = $_POST['procesos'];

//buscar las áreas implicadas
include("../../db/Conexion.php");
$conexion = new Conexion();
$consultaSQL = "SELECT * FROM procesos WHERE idproceso =$idProceso";
$result = $conexion->consultarDatos($consultaSQL);

$diasHabiles = fechaToDays($fechaInicio, $fechaFin);
$diasProceso = $result[0]['dias_proceso'];
$diferencia = $diasProceso - $diasHabiles;

?>
<div class="alert alert-dark " role="alert">
    El proceso seleccionado tiene por defecto <?php echo $diasProceso ?> dias hábiles.
</div>
<?php
if ($diasHabiles >= $diasProceso) { ?>

    <div class="alert alert-success " role="alert">
        Este pedido cumple con los días minimos para el proceso de las áreas.
    </div>
<?php
} else {
?>
    <div class="alert alert-danger " role="alert">
        Este pedido no cumple con los días minimos para el proceso de las áreas, con una diferencia de <?php echo $diferencia ?> dias menos. 
        Por Favor comunicarse con el comercial para rectificar <strong>Fecha de entrega.</strong> 
    </div>

    
    <?php }
#comparacion celda1
$dato1 = strtolower($result[0]['1']);
$tiempo1 = $result[0]['tiempo1'];
$dias1 = round($diasHabiles * $tiempo1);
$inicio1 = dayToFecha($fechaInicio, 0);
$final1 = dayToFecha($inicio1, $dias1 - 1);
if ($dato1 != '') {
    ?>
    <div class="row row-cols-1 row-cols-md-2">
        <div class="col mb-4 mx-auto my-0">
            <div class="card  alert-dark">
                    <div class="card-body text-center">
                    <h5 class="card-title text-uppercase"><?php echo $dato1 ?></h5>
                    <p class="card-text">Días Hábiles: <?php echo $dias1 ?></p>
                    <p class="card-text">Fecha Inicio: <?php echo $inicio1 ?></p>
                    <p class="card-text">Fecha Entrega: <?php echo $final1 ?></p>

                </div>
            </div>
        </div>
    <?php
}
#comparacion celda2
$dato2 = strtolower($result[0]['2']);
$tiempo2 = $result[0]['tiempo2'];
$dias2 = round($diasHabiles * $tiempo2);
$inicio2 = dayToFecha($final1, 1);
$final2 = dayToFecha($inicio2, $dias2 - 1);
if ($dato2 != '') {
    ?>
        <div class="col mb-4 mx-auto">
            <div class="card alert-dark">
                <div class="card-body text-center ">
                    <h5 class="card-title text-uppercase"><?php echo $dato2 ?></h5>
                    <p class="card-text">Días Hábiles: <?php echo $dias2 ?></p>
                    <p class="card-text">Fecha Inicio: <?php echo $inicio2 ?></p>
                    <p class="card-text">Fecha Entrega: <?php echo $final2 ?></p>

                </div>
            </div>
        </div>
    <?php
}
#comparacion celda3
$dato3 = strtolower($result[0]['3']);
$tiempo3 = $result[0]['tiempo3'];
$dias3 = round($diasHabiles * $tiempo3);
$inicio3 = dayToFecha($final2, 1);
$final3 = dayToFecha($inicio3, $dias3 - 1);
if ($dato3 != '') {
    ?>
        <div class="col mb-4 mx-auto">
            <div class="card alert-dark">
                <div class="card-body text-center">
                    <h5 class="card-title text-uppercase"><?php echo $dato3 ?></h5>
                    <p class="card-text">Días Hábiles: <?php echo $dias3 ?></p>
                    <p class="card-text">Fecha Inicio: <?php echo $inicio3 ?></p>
                    <p class="card-text">Fecha Entrega: <?php echo $final3 ?></p>

                </div>
            </div>
        </div>
    <?php
}
#comparacion celda4
$dato4 = strtolower($result[0]['4']);
$tiempo4 = $result[0]['tiempo4'];
$dias4 = round($diasHabiles * $tiempo4);
$inicio4 = dayToFecha($final3, 1);
$final4 = dayToFecha($inicio4, $dias4 - 1);
if ($dato4 != '') {
    ?>
        <div class="col mb-4 mx-auto">
            <div class="card alert-dark">
                <div class="card-body text-center">
                    <h5 class="card-title text-uppercase"><?php echo $dato4 ?></h5>
                    <p class="card-text">Días Hábiles: <?php echo $dias4 ?></p>
                    <p class="card-text">Fecha Inicio: <?php echo $inicio4 ?></p>
                    <p class="card-text">Fecha Entrega: <?php echo $final4 ?></p>

                </div>
            </div>
        </div>
    <?php
}
#comparacion celda5
$dato5 = strtolower($result[0]['5']);
$tiempo5 = $result[0]['tiempo5'];
$dias5 = round($diasHabiles * $tiempo5);
$inicio5 = dayToFecha($final4, 1);
$final5 = dayToFecha($inicio5, $dias5 - 1);
if ($dato5 != '') {
    ?>
        <div class="col mb-4 mx-auto">
            <div class="card alert-dark">
                <div class="card-body text-center">
                    <h5 class="card-title text-uppercase"><?php echo $dato5 ?></h5>
                    <p class="card-text">Días Hábiles: <?php echo $dias5 ?></p>
                    <p class="card-text">Fecha Inicio: <?php echo $inicio5 ?></p>
                    <p class="card-text">Fecha Entrega: <?php echo $final5 ?></p>

                </div>
            </div>
        </div>
    <?php
}
#comparacion celda6
$dato6 = strtolower($result[0]['6']);
$tiempo6 = $result[0]['tiempo6'];
$dias6 = round($diasHabiles * $tiempo6);
$inicio6 = dayToFecha($final5, 1);
$final6 = dayToFecha($inicio6, $dias6 - 1);
if ($dato6 != '') {
    ?>
        <div class="col mb-4 mx-auto">
            <div class="card alert-dark">
                <div class="card-body text-center">
                    <h5 class="card-title text-uppercase"><?php echo $dato6 ?></h5>
                    <p class="card-text">Días Hábiles: <?php echo $dias6 ?></p>
                    <p class="card-text">Fecha Inicio: <?php echo $inicio6 ?></p>
                    <p class="card-text">Fecha Entrega: <?php echo $final6 ?></p>

                </div>
            </div>
        </div>
    <?php
}




    ?>
    </div>