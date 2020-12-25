<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../');
} else {
    include("../../db/Conexion.php");
    include("../php/funcionFecha.php");
    $hoy = date('Y-m-d');
    $tresDias = dayToFecha($hoy, 3);
    $pieChart = array();
    $conexion = new Conexion();
    $consultaSQL = "SELECT count(num_pedido) as 'contar' FROM pedidos WHERE fecha_fin<'$hoy' AND estado<3;";
    $pedidos = $conexion->consultarDatos($consultaSQL);
    $pieChart[] = $pedidos[0]['contar'];
    $consultaSQL = "SELECT count(num_pedido) as 'contar' FROM pedidos WHERE fecha_fin BETWEEN '$hoy' AND '$tresDias' AND estado<3;";
    $pedidos = $conexion->consultarDatos($consultaSQL);
    $pieChart[] = $pedidos[0]['contar'];
    $consultaSQL = "SELECT count(num_pedido) as 'contar' FROM pedidos WHERE fecha_fin > '$tresDias' AND estado<3;";
    $pedidos = $conexion->consultarDatos($consultaSQL);
    $pieChart[] = $pedidos[0]['contar'];

    $datos = json_encode($pieChart);
}
?>

<div id="pieChart"></div>

<script>
    function convertirJson(json) {
        var parsed = JSON.parse(json);
        var arr = [];
        for (var x in parsed) {
            arr.push(parsed[x]);
        }
        return arr;
    }
</script>
<script>
 datos=convertirJson('<?php echo($datos)?>')
    var data = [{
        values: datos,
        labels: ['Atrasados', '0 a 3 días', '> 3 días'],
        type: 'pie',
        marker: {
            colors: ['#F60F24', '#E5F60F', '#29DE21'],
        },
        textinfo: "label+percent",
        insidetextorientation: "radial"
    }];

    var layout = {
        title: '<b>Gráfico General de Pedidos del <?php echo(date('d/m/Y'))?></b>',
        height: 500,
        width: 900
    };

    Plotly.newPlot('pieChart', data, layout);
</script>