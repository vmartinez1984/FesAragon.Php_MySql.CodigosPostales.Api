<?php
include_once 'Conexion.php';

class CodigoPostalRepository extends Conexion
{
    public function __construct()
    {
        parent::__construct();
    }

    public function obtener_por_estado_y_alcadia($estado, $alcaldia)
    {
        $query = null;
        $resultado = null;
        $datos = null;
        $tipo = null;
        $sentencia = null;

        if (is_numeric($estado) && is_numeric($alcaldia)) {
            $query = "SELECT codigoPostal, estado, estadoId, alcaldia, alcaldiaId, tipoDeAsentamiento, asentamiento FROM codigopostal WHERE EstadoId = ? AND AlcaldiaId = ?";
            $tipo = "ii";
        } else if (is_numeric($estado) && !is_numeric($alcaldia)) {
            $query = "SELECT codigoPostal, estado, estadoId, alcaldia, alcaldiaId, tipoDeAsentamiento, asentamiento FROM codigopostal WHERE EstadoId = ? AND Alcaldia = ?";
            $tipo = "is";
        } else if (!is_numeric($estado) && is_numeric($alcaldia)) {
            $query = "SELECT codigoPostal, estado, estadoId, alcaldia, alcaldiaId, tipoDeAsentamiento, asentamiento FROM codigopostal WHERE Estado = ? AND AlcaldiaId = ?";
            $tipo = "si";
        } else if (!is_numeric($estado) && !is_numeric($alcaldia)) {
            $query = "SELECT codigoPostal, estado, estadoId, alcaldia, alcaldiaId, tipoDeAsentamiento, asentamiento FROM codigopostal WHERE Estado = ? AND Alcaldia = ?";
            $tipo = "ss";
        }
        //echo $query;
        $sentencia = $this->mysqli->prepare($query);
        $sentencia->bind_param($tipo, $estado, $alcaldia);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        $datos = $resultado->fetch_all(MYSQLI_ASSOC);

        return $datos;
    }

    public function obtener_por_codigo_postal($codigoPostal)
    {
        $query = null;
        $resultado = null;
        $datos = null;
        $sentencia  = null;

        $query = "SELECT codigoPostal, estado, estadoId, alcaldia, alcaldiaId, tipoDeAsentamiento, asentamiento FROM CodigoPostal WHERE CodigoPostal = ?";
        $sentencia = $this->mysqli->prepare($query);
        $sentencia->bind_param('s', $codigoPostal);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        $datos = $resultado->fetch_all(MYSQLI_ASSOC);

        return $datos;
    }

    public function obtener_aleatorio()
    {        
        $query = null;
        $resultado = null;
        $datos = null;
        $sentencia = null;
        $id = null;
        $total = null;

        $query = "SELECT COUNT(id) total FROM codigopostal";
        $sentenci = $this->mysqli->prepare($query);
        $sentenci->execute();
        $resultado = $sentenci->get_result();
        $total = $resultado->fetch_all(MYSQLI_ASSOC);
        //print_r($total);
        $id = rand(1, (int)$total[0]['total']);
        //echo $id;
        $query = "SELECT codigoPostal, estado, estadoId, alcaldia, alcaldiaId, tipoDeAsentamiento, asentamiento FROM codigopostal WHERE id = ? LIMIT 1";
        $sentencia = $this->mysqli->prepare($query);
        $sentencia->bind_param('i', $id);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        $datos = $resultado->fetch_all(MYSQLI_ASSOC);

        return $datos[0];
    }
}
