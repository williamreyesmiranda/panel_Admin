<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../');
} else {
    include("../../db/Conexion.php");
    include("../php/funcionFecha.php");
    $hoy = date('Y-m-d');
    $tresDias = dayToFecha($hoy, 3);
    $conexion = new Conexion();
    $barraX = array();
    $barraYAtrasados = array();
    $barraY3dias = array();
    $barraY4dias = array();
    $consultaSQL = "SELECT usuario FROM asesor ORDER BY usuario";
    $asesores = $conexion->consultarDatos($consultaSQL);
    foreach ($asesores as $asesor) {
        $barraX[] = $asesor['usuario'];
        $usuario = $asesor['usuario'];
        $consultaSQL = "SELECT count(num_pedido) as 'contar' FROM pedidos WHERE asesor='$usuario' AND estado<3 AND fecha_fin<'$hoy' ";
        $result = $conexion->consultarDatos($consultaSQL);
        $barraYAtrasados[] = $result[0]['contar'];
        $consultaSQL = "SELECT count(num_pedido) as 'contar' FROM pedidos WHERE asesor='$usuario' AND estado<3 AND fecha_fin BETWEEN '$hoy' AND '$tresDias' ";
        $result = $conexion->consultarDatos($consultaSQL);
        $barraY3dias[] = $result[0]['contar'];
        $consultaSQL = "SELECT count(num_pedido) as 'contar' FROM pedidos WHERE asesor='$usuario' AND estado<3 AND fecha_fin >'$tresDias' ";
        $result = $conexion->consultarDatos($consultaSQL);
        $barraY4dias[] = $result[0]['contar'];
    }
    $datosX = json_encode($barraX);
    $datosYAtrasados = json_encode($barraYAtrasados);
    $datosY3dias = json_encode($barraY3dias);
    $datosY4dias = json_encode($barraY4dias);
}
?>

<div id="barChart"></div>

<!-- script JSON -->
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
    datosX = convertirJson('<?php echo ($datosX) ?>');
    datosYAtrasados = convertirJson('<?php echo ($datosYAtrasados) ?>');
    datosY3dias = convertirJson('<?php echo ($datosY3dias) ?>');
    datosY4dias = convertirJson('<?php echo ($datosY4dias) ?>');

    var xValue = datosX;
    var yValue = datosYAtrasados;
    var yValue2 = datosY3dias;
    var yValue3 = datosY4dias;

    var trace1 = {
        x: xValue,
        y: yValue,
        name: 'Atrasados',
        type: 'bar',
        text: yValue.map(String),
        textposition: 'auto',
        opacity: 0.7,
        marker: {
            color: '#c00808',
            line: {
                color: 'rgb(0,0,0)',
                width: 1.5
            }
        }
    };

    var trace2 = {
        x: xValue,
        y: yValue2,
        name: '0 a 3 días',
        type: 'bar',
        text: yValue2.map(String),
        textposition: 'auto',
        opacity: 0.7,
        marker: {
            color: '#f1cd00',
            line: {
                color: 'rgb(0,0,0)',
                width: 1.5
            }
        }
    };
    var trace3 = {
        x: xValue,
        y: yValue3,
        name: '> 3 días',
        type: 'bar',
        text: yValue3.map(String),
        textposition: 'auto',
        opacity: 0.7,
        marker: {
            color: '#20a14b',
            line: {
                color: 'rgb(0,0,0)',
                width: 1.5
            }
        }
    };

    var data = [trace1, trace2, trace3];

    var layout = {
        title: '<b>Reporte de Pedidos X Comercial del <?php echo (date('d/m/Y')) ?></b>',
        height: 400,
        xaxis: {
            title: 'Asesores',
            tickfont: {
                size: 14,
                color: 'rgb(107, 107, 107)'
            }
        },
        yaxis: {
            title: 'Pedidos',
            titlefont: {
                size: 16,
                color: 'rgb(107, 107, 107)'
            },
            tickfont: {
                size: 14,
                color: 'rgb(107, 107, 107)'
            }
        },
        legend: {
            x: 0,
            y: 1.0,
            bgcolor: 'rgba(255, 255, 255, 0)',
            bordercolor: 'rgba(255, 255, 255, 0)'
        },
        barmode: 'group',
        bargap: 0.15,
        bargroupgap: 0.1

    };

    Plotly.newPlot('barChart', data, layout);
</script>