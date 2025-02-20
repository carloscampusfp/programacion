<?php
require_once __DIR__ . "/../conexion/conexion.php";

class Receta{

    private $conexion;

    public function __construct(){
        $this->conexion = new Conexion();
    }

    public function listarRecetas(){
        $query = "SELECT * FROM recetas";
        $resultado = $this->conexion->conexion->query($query);
        return $resultado->fetch_all(MYSQLI_ASSOC);

    }


    public function crearReceta($nombre, $descripcion){
        $query =  "INSERT INTO recetas (nombre, descripcion) VALUES (?, ?)";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt-> bind_param("ss", $nombre, $descripcion); 

        if ($stmt->execute()){
            echo "<div class='alert alert-success'>Receta registrado con éxito.</div>";
            header("Location: http://localhost/php/programacion/hoja13/vistas/verRecetas.php");
        }else {
            echo "<div class='alert alert-danger'>" . "Error al registrar Receta: " . $stmt->error . "</div>";
        }
        $stmt->close();
    }

    public function eliminarReceta($id){
        $query =  "DELETE FROM recetas WHERE id = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt-> bind_param("i", $id); 

        if ($stmt->execute()){
            echo "<div class='alert alert-success'>Receta eliminada con éxito.</div>";
            header("Location: ../vistas/verRecetas.php");
        }else {
            echo "<div class='alert alert-danger'>" . "Error al eliminar Receta: " . $stmt->error . "</div>";
        }
        $stmt->close();
    }

    public function editarReceta($id, $nombre, $descripcion)
    {
        $query = "UPDATE recetas SET nombre = ?, descripcion = ? WHERE id = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("ssi", $nombre, $descripcion, $id);
        if ($stmt->execute()){
            echo "<div class='alert alert-success'>Receta editada con éxito.</div>";
            header("Location: ../vistas/verRecetas.php");
        }else {
            echo "<div class='alert alert-danger'>" . "Error al editar Receta: " . $stmt->error . "</div>";
        }
        $stmt->close();
    }
}