<?php 
session_start();
include("../../db/Conexion.php");
$usuario=$_SESSION['nombre'];
$idUsuario=$_SESSION['iduser'];
$idPedido=$_POST['idPedido'];
$idNovedad=$_POST['idNovedad'];
$cliente=$_POST['cliente'];
$nroPedido=$_POST['nroPedido'];
$novedad=$_POST['novedad'];
$correoUsuario=$_SESSION['correo'];
$asesor=$_POST['asesor'];
$area="bodega";

echo($idNovedad);
$conexion= new Conexion();
//buscar correo asesor
$consultaSQL="SELECT correo, nombre FROM asesor WHERE usuario='$asesor'";
$result=$conexion->consultarDatos($consultaSQL);
$correoAsesor=$result[0]['correo'];
$nombreAsesor=$result[0]['nombre'];

if($idNovedad>0){
    $consultaSQL="UPDATE novedades SET novedad='$novedad', estado=0   
           WHERE idNovedad='$idNovedad'";
$result=$conexion->editarDatos($consultaSQL);
$consultaSQL="SELECT area FROM novedades  
           WHERE idNovedad='$idNovedad'";
$result=$conexion->consultarDatos($consultaSQL);
$destinatario = $correoAsesor; 
        $asunto = "Novedad Finalizada para el pedido N°".$nroPedido; 
        $cuerpo = " 
        <html> 
        <body> 
        <h1 style=\" text-transform: uppercase;\">Hola ".$nombreAsesor."</h1> 
        <p> 
        <b>La novedad N°".$idNovedad." del área ".$area." ha finalizado.</b>. <br><br>
        <b>Observaciones:</b> <br>".
        $novedad."<br><br>
        Esta novedad está relacionada con el pedido ".$nroPedido.", cliente ".$cliente."<br>
        Quien finalizó esta novedad fue: ".$usuario."<br><br>        
        Cualquier duda responder este mensaje, que será reenviado a la persona que realizó esta novedad. <br>
        </p> 
        </body> 
        </html> 
        <meta charset=\"utf-8\" />
        "; 
        //para el envío en formato HTML 
        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
        
        //dirección del remitente 
        $headers .= "From: K-misetas.com.co <noreply@intranetk-misetas.com>\r\n"; 
        
        //dirección de respuesta, si queremos que sea distinta que la del remitente 
        $headers .= "Reply-To:".$correoUsuario."\r\n"; 
        
        //ruta del mensaje desde origen a destino 
        $headers .= "Return-path:".$correoAsesor."\r\n"; 
        
        //direcciones que recibián copia 
        $headers .= "Cc:".$correoUsuario."\r\n"; 
        
        //direcciones que recibirán copia oculta 
        /* $headers .= "Bcc: pepe@pepe.com,juan@juan.com\r\n";  */
        $mail=mail($destinatario,$asunto,$cuerpo,$headers);
       
}else{
    $result="No se ha reportado ninguna novedad para este pedido.";
}
echo json_encode($result);
//consultar el ultimo id de tabla novedades