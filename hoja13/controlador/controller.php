<?php
require_once "../modelo/model.php";

class Controller{
    private $modelo;

    public function __construct(){
        $this->modelo = new Receta();
    }

    public function listarRecetas(){
        return $this->modelo->listarRecetas();
    }

    public function eliminarReceta($id){
        $this->modelo->eliminarReceta($id);
    }

    public function editarReceta($id, $nombre, $descripcion){
        $this->modelo->editarReceta($id, $nombre, $descripcion);
    }
}