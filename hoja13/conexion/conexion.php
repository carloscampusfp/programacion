<?php

class Conexion{
    private $servidor = 'localhost';
    private $usuario = 'root';
    private $password = 'curso';
    private $database = 'recetas';
    public $conexion;

    public function __construct(){
        try {
            $this->conexion = new mysqli($this->servidor, $this->usuario, $this->password, $this->database);
        } catch (mysqli_sql_exception $e) {
            echo "<div class='alert alert-danger'>" . "Error: " . $e->getMessage() . "</div>"; 
        }
    }

    public function cerrar(){
        $this->conexion->close();
    }
}