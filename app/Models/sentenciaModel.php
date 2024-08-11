<?php

class SentenciaModel
{
    private $sentencia;
    private $conexion;
    private $tabla;
    private $resultado;

    // Constructor
    public function __construct($sentencia, $conexion, $tabla)
    {
        $this->sentencia = $sentencia;
        $this->conexion = $conexion;
        $this->tabla = $tabla;
    }

    // Ejecutar la consulta
    public function ejecutarConsulta()
    {
        $this->resultado = mysqli_query($this->conexion, $this->sentencia) or die('No se ejecutó la consulta a la tabla ' . $this->tabla . ': ' . mysqli_error($this->conexion));
    }

    // Obtener el resultado de la consulta
    public function getResultado()
    {
        return $this->resultado;
    }

    // Insertar, editar y borrar
    public function insertarDBO()
    {
        $resultado = mysqli_query($this->conexion, $this->sentencia);
        if ($resultado === false) {
            die('Error al ejecutar la operación en la tabla ' . $this->tabla . ': ' . mysqli_error($this->conexion) . '. Consulta: ' . $this->sentencia);
        }
    }
}
?>