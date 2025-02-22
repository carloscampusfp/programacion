<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../auth/login.php");
    exit;
} elseif ($_SESSION["rol"] !== "admin") {
?>
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
    header("Refresh: 3; URL=../auth/index.php");
    exit;
}

require_once "../../controlador/UsuariosController.php";

// Verificamos si el ID está presente en la URL
if (isset($_GET["id"])) {
    try {
        // Eliminamos el usuario por su ID
        $controller = new UsuariosController();
        $controller->eliminarUsuario($_GET["id"]);
        $_SESSION["mensaje"] = "Usuario eliminado correctamente.";
        $_SESSION["mensaje_tipo"] = "success";
    } catch (mysqli_sql_exception $e) {
        $_SESSION["mensaje"] = "Error: " . $e->getMessage();
        $_SESSION["mensaje_tipo"] = "danger";
    }
} else {
    $_SESSION["mensaje"] = "Error: No se ha recibido un ID de usuario.";
    $_SESSION["mensaje_tipo"] = "danger";
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php include_once "../includes/encabezado.php"; ?>
    <div class="container my-5 text-center">
        <h1 class="mb-4">Eliminar Usuario</h1>
        <!-- Mostrar mensaje -->
        <?php include_once "../includes/mensaje.php"; ?>
        <!-- Volver a la lista de usuarios -->
        <a href="lista_usuarios.php" class="btn btn-primary">Volver a la lista de usuarios</a>
    </div>
</body>

</html>