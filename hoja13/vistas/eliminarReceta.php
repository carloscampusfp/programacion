<?php

require_once __DIR__ . "/../controlador/controller.php";

$id_receta = $_POST["id_receta"];
$eliminar = new Controller();

$eliminar->eliminarReceta($id_receta);


