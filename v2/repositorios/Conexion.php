<?php

class Conexion{

	public $mysqli;

	public function __construct(){        
      try{        
        $server = "localhost";
        $server ="192.168.1.86";
        //$server = "localhost:3306";
        $usuario = "root";
        $contrasenia = "123456";
        $baseDeDatos= "CodigosPostales";
        // $server = "vmartinez84.xyz:3306";
        // $usuario = "vmartinez_CodigosPostales";
        // $contrasenia = "Macross#2012";
        // $baseDeDatos = "vmartinez_codigos_postales";
        $puerto = 3306;

        $this->mysqli = new mysqli($server, $usuario, $contrasenia, $baseDeDatos, $puerto);
        if ($this->mysqli->connect_errno) {
            echo "Error en la conexion" . $this->mysqli->connect_error;
        }
      }catch(Exception $ex){
        //print_r($ex);
      }
    }
}