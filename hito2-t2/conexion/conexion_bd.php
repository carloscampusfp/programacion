<?php
class Conexion /* creamos esta clase para poder conectarnos correctamente a la base de datos */
{
    private $servidor = "localhost";
    private $usuario = "root";
    private $password = "curso";
    private $base_datos = "gestion_tareas";
    public $conexion;

    public function __construct()
    {
        try {
            $this->conexion = new mysqli($this->servidor, $this->usuario, $this->password, $this->base_datos);
        } catch (mysqli_sql_exception) {
            die("Error de conexión a la base de datos $this->base_datos.");
        }
    }

    public function cerrar()
    {
        $this->conexion->close();
    }
}