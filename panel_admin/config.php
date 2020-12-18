<?php

// Datos de conexion a la base de datos
$servidor='localhost';
$usuario='intranet_william';
$pass='wrm1124023751';
$bd='intranet_clientes';

// Nos conectamos a la base de datos
$conexion = new mysqli($servidor, $usuario, $pass, $bd);	

// Definimos que nuestros datos vengan en utf8
$conexion->set_charset('utf8');

// verificamos si hubo algun error y lo mostramos
if ($conexion->connect_errno) {
	echo "Error al conectar la base de datos {$conexion->connect_errno}";
}

// Url donde estara el proyecto, debe terminar con un "/" al final


?>
