
   <?php
    include("../../db/Conexion.php");
    $idReferencia = $_POST['idReferencia'];
    $idColor = $_POST['idColor'];
    $disponibles = $_POST['disponibles'];
    $conexion = new Conexion();
    $numTalla = 1;
    foreach ($disponibles as $disponible) {
        $consultaSQL = "UPDATE referencia_color SET d$numTalla=$disponible WHERE color_referencia=$idColor AND referencia_color=$idReferencia;";
        $editar = $conexion->editarDatos($consultaSQL);
        $numTalla++;
    }

    echo json_encode($editar);
