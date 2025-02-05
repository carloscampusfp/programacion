<?php
require_once "./encabezado.html";
require_once "../modelo/class_Evento.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["nombre"] ?? null;
    $fecha = $_POST["fecha"] ?? null;
    $lugar = $_POST["lugar"] ?? null;
    try {
        $controller = new Evento();
        $controller->agregarEvento($nombre, $fecha, $lugar);
    } catch (mysqli_sql_exception $e) {
        echo "<div class='alert alert-danger'>" . "Error: " . $e->getMessage() . "</div>";  
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agregar Evento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Agregar Evento</h1>
        <form action="alta_evento.php" method="POST">

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha:</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>
            <div class="mb-3">
                <label for="lugar" class="form-label">Lugar:</label>
                <input type="text" class="form-control" id="lugar" name="lugar" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar evento</button>
            <a href="lista_eventos.php" class="btn btn-secondary">Cancelar</a>

        </form>
    </div>
</body>

</html>