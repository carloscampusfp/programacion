<?php
require "../paginas/encabezado.html";
require_once "./controlador.php";



// Crear una instancia del controlador y obtener los usuarios
$controlador = new Usuario();
$usuarios = $controlador->obtenerUsuarios();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Lista de Usuarios</title>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center text-primary mb-4">Lista de Usuarios</h1>
    
    <?php if (!empty($usuarios)): ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover shadow-lg rounded-4">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Correo</th>
                        <th>Edad</th>
                        <th>Plan</th>
                        <th>Paquete</th>
                        <th>Duración</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?= htmlspecialchars($usuario['id']) ?></td>
                            <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                            <td><?= htmlspecialchars($usuario['apellidos']) ?></td>
                            <td><?= htmlspecialchars($usuario['correo']) ?></td>
                            <td><?= htmlspecialchars($usuario['edad']) ?></td>
                            <td><?= htmlspecialchars($usuario['plan']) ?></td>
                            <td><?= htmlspecialchars($usuario['paquete']) ?></td>
                            <td><?= htmlspecialchars($usuario['duracion']) ?></td>
                            <td><?= number_format($usuario['precio'], 2) ?>€</td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center">No hay usuarios registrados.</div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>