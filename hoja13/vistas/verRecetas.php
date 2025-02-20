<?php
require_once "../encabezado.html";
require_once "../controlador/controller.php";

$controlador = new Controller();
$recetas = $controlador->listarRecetas();

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
    <h1>RECETAS GUARDADAS</h1>
    <div class="container mt-5">

        <div class="row row-cols-1 row-cols-md-3 g-4">
                
                <?php foreach ($recetas as $receta): ?>
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title text-center"><?= ucfirst($receta["nombre"]) ?></h5>
                                <div class="card-text" style="max-height: 15rem; overflow-y: auto">
                                    <!-- Contenido del artículo -->
                                    <?= nl2br($receta["descripcion"]) ?>
                                </div>
                                <!-- Botones para editar y eliminar receta -->
                                <div class="d-flex justify-content-center gap-2 mt-2 ">
                                    <form action="editar.php" method="POST">
                                        <input type="hidden" name="id_receta" value="<?= htmlspecialchars($receta["id"]) ?>">
                                        <button type="submit" class="btn btn-success ">Editar</button>
                                    </form>
                                    <form action="eliminarReceta.php" method="POST">
                                        <input type="hidden" name="id_receta" value="<?= $receta["id"] ?>">
                                        <button type="submit" name="eliminar_submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        
      
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>