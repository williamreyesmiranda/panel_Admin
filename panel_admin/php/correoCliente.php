<?php
session_start();
include("../../db/Conexion.php");
$correoAsesor=$_POST['correoAsesor'];
$nombreAsesor=$_POST['nombreAsesor'];
$correoCliente=$_POST['correoCliente'];
$nombreCliente=$_POST['nombreCliente'];
$nroPedido=$_POST['nroPedido'];


$conexion = new Conexion();
//consulta del total de unds del pedido
$consultaSQL = "SELECT sum(unds) as 'undsPedido' FROM pedidos WHERE num_pedido='$nroPedido' AND estado !=3 ";
$result = $conexion->consultarDatos($consultaSQL);
$undsPedido=$result[0]['undsPedido'];

//consulta del total de unds terminados
$consultaSQL = "SELECT sum(unds) as 'undsPedido' FROM pedidos WHERE num_pedido='$nroPedido' AND estado =4 ";
$result = $conexion->consultarDatos($consultaSQL);
$undsTerminadas=$result[0]['undsPedido'];

if($undsPedido==$undsTerminadas){
    $destinatario = $correoAsesor; 
        $asunto = "Pedido ".$nroPedido." terminado"; 
        $cuerpo = " 
        <html> 
        
        <body> 
        <h1 style=\" text-transform: uppercase;\">".$nombreAsesor."</h1> 
        <p> 
        
        <b>Te informamos que este pedido se encuentra listo para entrega</b>. <br><br>
        Información del pedido <br>
        Pedido: ".$nroPedido."<br>
        Unds: ".$undsTerminadas."<br>
        
        
        </p> 
        </body> 
        </html> 
        "; 
        
        //para el envío en formato HTML 
        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
        
        //dirección del remitente 
        $headers .= "From: No Responder <noreply@intranetk-misetas.com>\r\n"; 
        
        //dirección de respuesta, si queremos que sea distinta que la del remitente 
        //$headers .= "Reply-To:".$correoAsesor."\r\n"; 
        
        //ruta del mensaje desde origen a destino 
        /* $headers .= "Return-path:".$correoCliente."\r\n";  */
        
        //direcciones que recibián copia 
        //$headers .= "Cc:".$correoAsesor."\r\n"; 
        
        //direcciones que recibirán copia oculta 
        /* $headers .= "Bcc: pepe@pepe.com,juan@juan.com\r\n";  */
        
        $mail=@mail($destinatario,$asunto,$cuerpo,$headers);
       if($mail){
        $respuesta=1;
       }else{
        $respuesta="error";
       }
       
}else{
    $respuesta=2;
}
echo json_encode($respuesta);
