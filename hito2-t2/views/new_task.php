<?php
session_start();
require_once "../views/encabezado.php";
require_once "../controller/controller.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $nombre_tarea = $_POST["nombre_tarea"] ?? null;
    $descripcion = $_POST["descripcion"] ?? null;
    try{
        $controller = new User();
        $controller->agregarTareas($nombre_tarea, $descripcion, $_SESSION['usuario']);/* creamos una nueva tarea asociandola al usuario con el que tenems iniciada la sesion */
    }catch (mysqli_sql_exception $e){
        echo "<div class='alert alert-danger'>" . "Error: " . $e->getMessage() . "</div>"; 
    }
}





?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Crear tarea</h1>
        <form action="new_task.php" method="POST">
            <div class="mb-3">
                <label for="nombre_tarea" class="form-label">Nombre tarea:</label>
                <input type="text" class="form-control" id="nombre_tarea" name="nombre_tarea" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <textarea type="textarea" class="form-control" rows="4" id="descripcion" name="descripcion" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Agregar tarea</button>
            <a href="../views/lista_tareas.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>

</html>