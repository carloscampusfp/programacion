<?php

require_once "encabezado.html";
require_once "modelo/model.php";
require_once "vistas/llama.php";

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow p-4">
            <h2 class="text-center mb-4">Añadir Nueva Receta</h2>
            
            <form action="index.php" method="POST">
                <div class="mb-3">
                    <label for="recetaNombre" class="form-label">Nombre de la receta</label>
                    <input type="text" class="form-control" id="recetaNombre" name="recetaNombre" placeholder="Ejemplo: Tarta de Chocolate" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-100">Guardar Receta</button>
                </div>
            </form>
        </div>

        <!-- Sección para mostrar la descripción fuera del formulario -->
        <div class="card shadow p-4 mt-4">
            <h4 class="text-center">Descripción de la Receta</h4>
            <p class="mt-3"><?php echo $message; ?></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
