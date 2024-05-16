<?php
include_once 'Conexion.php';

class EstadoRepository extends Conexion
{
    public function __construct() { parent::__construct(); }

    public function obtener_todos(){ 
        $query = "SELECT DISTINCT(Estado), EstadoId FROM CodigoPostal";
        $sentencia = $this->mysqli->prepare($query);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        $datos = $resultado->fetch_all(MYSQLI_ASSOC);       

        return $datos;
    }
}