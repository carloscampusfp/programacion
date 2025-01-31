<?php
require_once "./controlador.php";
require_once "../paginas/encabezado.html";


if($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"] ?? null;
    try{
        $controlador = new Usuario();
        $controlador->eliminarUsuario($id);
    } catch (mysqli_sql_exception $e) {
        echo "<div class='alert alert-danger'>" . "Error: " . $e->getMessage() . "</div>";
    }

}



?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Añadir Usuario</title>
</head>
<body>
<div class="container mt-5">
        <h1 class="text-center mb-4 text-primary">Eliminar Usuario</h1>
        <form action="eliminar.php" method="POST" class="p-4 shadow-lg rounded-4 bg-light">
           <!-- Campo de ID -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Id</label>
                <input type="number" class="form-control" id="id" name="id" placeholder="Excribe el id que identifica al usuario" required>
            </div>
            <!-- Botón de Enviar -->
            <button type="submit" class="btn btn-primary w-100">Eliminar Usuario</button>
        </form>
    </div>
       
</body>
</html>



