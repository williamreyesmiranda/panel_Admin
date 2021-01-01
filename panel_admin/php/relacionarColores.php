
   <?php
   include("../../db/Conexion.php");
   $idReferencia = $_POST['idReferencia'];
   $colores = $_POST['colores'];
   $conexion = new Conexion();
   $contar=1;
   
   foreach ($colores as $color) {
      $consultaSQL = "SELECT * FROM referencia_color WHERE referencia_color='$idReferencia' AND color_referencia='$color'";
      $result = $conexion->consultarDatos($consultaSQL);
      if ($result) {
      } else {
         $consultaSQL = "INSERT INTO referencia_color (referencia_color, color_referencia)
                        values ($idReferencia, $color)";
         $agregar = $conexion->agregarDatos($consultaSQL);
      }
      $stocks = $_POST['stock'][$contar];
      $numTalla=1;
      foreach($stocks as $stock){
         $consultaSQL = "UPDATE referencia_color SET s$numTalla=$stock WHERE color_referencia=$color AND referencia_color=$idReferencia;";
         $editar = $conexion->editarDatos($consultaSQL);
         $numTalla++;
         
      }
      $contar++;
   }
   echo json_encode($editar);
