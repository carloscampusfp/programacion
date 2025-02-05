<?php
require_once "./encabezado.html";
require_once "../modelo/class_Evento.php";

$controler = new Evento();
$eventos = $controler->obtenerEventos();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de eventos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Eventos Registrados</h1>
        <table class="table table-striped table-bordered">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Lugar</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($eventos as $evento): ?>
                    <tr class="text-center">
                        <td><?= $evento['id_evento'] ?></td>
                        <td><?= $evento['nombre_evento'] ?></td>
                        <td><?= $evento['fecha'] ?></td>
                        <td><?= $evento['lugar'] ?></td>
                        <td>
                            <a href="editar_evento.php?id=<?= $evento['id_evento'] ?>" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            <a href="eliminar_evento.php?id=<?= $evento['id_evento'] ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Estás seguro de que deseas eliminar a este evento?');">
                                <i class="bi bi-trash"></i> Eliminar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="alta_evento.php" class="btn btn-success mb-3">Agregar un nuevo evento</a>
    </div>
</body>

</html>