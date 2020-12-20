<?php
include("../../db/Conexion.php");
$area = $_POST['area'];
$nroPedido = $_POST['nroPedido'];
$conexion = new Conexion();
$consulta = "SELECT pe.idpedido, pe.cliente, pro.siglas FROM pedidos pe
            INNER JOIN " . $area . " ar ON ar.pedido=pe.idpedido
            INNER JOIN procesos pro ON pro.idproceso=pe.procesos
            WHERE pe.num_pedido='$nroPedido' AND ar.estado>2";
$pedidos = $conexion->consultarDatos($consulta);
if($pedidos){
?>
<div class="col-md-12 text-center">
    <h5 class="alert alert-success">Pedidos Relacionados Para el N°<?php echo($nroPedido)?></h5>
</div>
<table class="table table-hover table-condensed table-bordered">
    <thead>
        <th></th>
        <th>Cliente</th>
        <th>Procesos</th>
    </thead>
    <tbody>
        <?php foreach ($pedidos as $pedido) : ?>
            <tr>
                <td><input type="checkbox" name="idPedido[]" value="<?php echo ($pedido['idpedido']) ?>" id=""></td>
                <td><?php echo ($pedido['cliente']) ?></td>
                <td><?php echo ($pedido['siglas']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php }else{ ?>
    <div class="col-md-12 text-center">
    <h5 class="text-capitalize alert alert-warning"><?php echo $area ?> no tiene pedidos con el n°<?php echo($nroPedido)?></h5>
</div>
<?php } ?>