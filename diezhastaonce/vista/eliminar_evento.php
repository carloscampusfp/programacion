<?php
require_once "./encabezado.html";
require_once "../modelo/class_Evento.php";

$id = $_GET["id"] ?? null;

try {
    $controller = new Evento();
    $controller->eliminarEvento($id);
} catch (mysqli_sql_exception $e) {
    echo "<div class='alert alert-danger'>" . "Error: " . $e->getMessage() . "</div>";  
}
       

?>

