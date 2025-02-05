<?php
require_once "../config/db_config.php";

class Evento{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    public function agregarEvento($nombre_evento, $fecha, $lugar){
        $query = "INSERT INTO eventos (nombre_evento, fecha, lugar) VALUES (?, ?, ?)";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("sss", $nombre_evento, $fecha, $lugar);

        if ($stmt->execute()){
            echo "<div class='alert alert-success'>Evento agregado con éxito.</div>";
        } else {
            echo "<div class='alert alert-danger'>" . "Error al agregar evento: " . $stmt->error . "</div>";
        }

        $stmt->close();
    }

    public function obtenerEventoPorId($id_evento)
    {
        $query = "SELECT * FROM eventos WHERE id_evento = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id_evento);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    public function obtenerEventos(){
        $query = "SELECT * FROM eventos";
        $resultado = $this->conexion->conexion->query($query);
        $eventos = [];
        while($fila = $resultado->fetch_assoc()){
            $eventos[] = $fila;
        }
        return $eventos;
    }

    public function actualizarEvento($id_evento, $nombre_evento, $fecha, $lugar){
        $query = "UPDATE eventos SET nombre_evento = ?, fecha = ?, lugar = ? WHERE id_evento = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("sssi", $nombre_evento, $fecha, $lugar, $id_evento);

        if($stmt->execute()){
            echo "<div class='alert alert-success'>Evento actualizado con éxito.</div>";
        }else{
            echo "<div class='alert alert-danger'>" . "Error al actualizar evento: " . $stmt->error . "</div>";
        }
        $stmt->close();
    }

    public function eliminarEvento($id_evento){
        $query = "DELETE FROM eventos WHERE id_evento = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id_evento);

        if($stmt->execute()){
            echo "<div class='alert alert-success'>Evento eliminado con éxito.</div>";
        }else{
            echo "<div class='alert alert-danger'>" . "Error al eliminar evento: " . $stmt->error . "</div>";
        }

        $stmt->close();
    }

}