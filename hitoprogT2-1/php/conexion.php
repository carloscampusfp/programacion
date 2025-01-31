<?php
class Conexion{ #clase para poder conectarnos a la base de datos
    private $servidor = "localhost";
    private $usuario = "root";
    private $password = "curso";
    private $base_datos = "streamweb";
    
    public $conexion;
 
    public function __construct(){ #usamos el construct para que use esta funcion al crearse el objeto de la clase de forma automática
        try{ #en caso de que la conexion falle, el codigo se detendrá y mostrara un mensaje de error
            $this->conexion = new mysqli($this->servidor, $this->usuario, $this->password, $this->base_datos);
        }catch (mysqli_sql_exception $e){
            echo "<div class='alert alert-danger'>" . "Error: " . $e->getMessage() . "</div>";
        }
    }
    
}