<?php

class Conexion
{
    //atributos
    public $usuarioDB = "intranet_william";
    public $passwordDB = "wrm1124023751";

    //constructor
    public function __construct()
    {
    }
    //metodos
    public function Conectar()
    {

        try {
            $datosDB = "mysql:host=localhost;dbname=intranet_clientes;charset=utf8";
            $conexionBD = new PDO($datosDB, $this->usuarioDB, $this->passwordDB);
            return ($conexionBD);
        } catch (PDOException $error) {
            echo $error->getMessage();
        }
    }

    public function agregarDatos($consultaSQL)
    {
        //establecer una conexion
        $conexionBD = $this->Conectar();

        //preparar consulta
        $insertarDatos = $conexionBD->prepare($consultaSQL);

        //ejecutar la consulta
        $resultado = $insertarDatos->execute();

        //verifico el resultado
        if ($resultado) {
            return 1;
        } else {
            echo "error";
        }
    }

    public function consultarDatos($consultaSQL)
    {
        //establecer una conexion
        $conexionBD = $this->Conectar();
        //preparar consulta
        $consultarDatos = $conexionBD->prepare($consultaSQL);
        //establacer el método de consulta
        $consultarDatos->setFetchMode(PDO::FETCH_ASSOC);
        //ejecutar la operacion en la base de datos
        $consultarDatos->execute();
        //obtener todos los datos
        return ($consultarDatos->fetchAll());
    }

    public function eliminarDatos($consultaSQL)
    {
        //establecer una conexion
        $conexionBD = $this->Conectar();
        //preparar consulta
        $eliminarDatos = $conexionBD->prepare($consultaSQL);
        //ejecutar la consulta
        $resultado = $eliminarDatos->execute();

        //verifico el resultado
        if ($resultado) {
            return 1;
        } else {
            echo "error";
        }
    }

    public function editarDatos($consultaSQL)
    {
        //establecer una conexion
        $conexionBD = $this->Conectar();
        //preparar consulta
        $editarDatos = $conexionBD->prepare($consultaSQL);
        //ejecutar la consulta
        $resultado = $editarDatos->execute();

        //verifico el resultado
        if ($resultado) {
            return 1;
        } else {
            echo "error";
        }
    }
    
}
