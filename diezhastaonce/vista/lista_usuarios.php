<?php
session_start();

// Redirigir al login
if (!isset($_SESSION['usuario'])) {
    header("Location: ../auth/login.php");
    exit();
} elseif ($_SESSION["rol"] !== "admin") { ?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Acceso Denegado</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>

    <body class="d-flex flex-column vh-100">
        <?php include_once "../includes/encabezado.php"; ?>
        <div class="container d-flex align-items-center justify-content-center flex-grow-1">
            <div class="card w-50">
                <div class="card-body text-center">
                    <h5 class="card-title mb-4 text-danger">No tienes permisos para acceder a esta página.</h5>
                    <p>Serás redirigido en 3 segundos...</p>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>

<?php
    header("Refresh: 3; URL=../../index.php");
    exit;
}

require_once "../../controlador/UsuariosController.php";
$controller = new UsuariosController();
$usuarios = $controller->obtenerUsuarios();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <?php include_once "../includes/encabezado.php"; ?>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Usuarios Registrados</h1>
        <table class="table table-striped table-bordered">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr class="text-center">
                        <td><?= $usuario['id_usuario'] ?></td>
                        <td><?= $usuario['usuario'] ?></td>
                        <td><?= $usuario['rol'] ?></td>
                        <td>
                            <a href="editar_usuario.php?id=<?= $usuario['id_usuario'] ?>" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            <a href="eliminar_usuario.php?id=<?= $usuario['id_usuario'] ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Estás seguro de que deseas eliminar a este usuario?');">
                                <i class="bi bi-trash"></i> Eliminar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="alta_usuario.php" class="btn btn-success mb-3">Agregar un nuevo usuario</a>
    </div>
</body>

</html>