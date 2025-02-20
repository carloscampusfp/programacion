<?php
require_once "../encabezado.html";
require_once __DIR__ . "/../controlador/controller.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $controlador = new Controller();
    $id_receta = $_POST["id_receta"] ?? null;
    

    // Editar receta si se ha enviado el formulario
    if (isset($_POST["editar_submit"])) {
        $nombre_receta = $_POST["recetaNombre"];
        $descripcion = $_POST["recetaDescripcion"];
        $controlador->editarReceta($id_receta, $nombre_receta, $descripcion);
       
    }
}
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
            <h2 class="text-center mb-4">Editar Receta</h2>
            
            <form action="editar.php" method="POST">
                <div class="mb-3">
                    <label for="recetaNombre" class="form-label">Nombre de la receta</label>
                    <input type="text" class="form-control" id="recetaNombre" name="recetaNombre" placeholder="Ejemplo: Tarta de Chocolate" required>
                </div>
                <div class="mb-3">
                    <label for="recetaDescripcion" class="form-label">Descripción de la receta</label>
                    <input type="text" class="form-control" id="recetaDescripcion" name="recetaDescripcion" required>
                </div>

                <div class="text-center">
                    <input type="hidden" name="id_receta" value="<?= htmlspecialchars($id_receta) ?>">
                    <button type="submit" name="editar_submit" class="btn btn-primary w-100">Editar Receta</button>
                </div>
            </form>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>