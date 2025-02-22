<?php
session_start();

require_once "../../controlador/UsuariosController.php";
$controller = new UsuariosController();

// Redirigir al usuario si ya ha iniciado sesión
if (isset($_SESSION["usuario"])) {
    $controller->redirigirUsuario($_SESSION["rol"]);
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    try {
        // Autenticar al usuario
        if (!empty($usuario)) {
            if ($controller->autenticarUsuario($usuario, $password)) {
                $_SESSION["usuario"] = $usuario;
                $_SESSION["rol"] = $controller->obtenerRol($usuario);
                $controller->redirigirUsuario($_SESSION["rol"]);
            } else {
                $_SESSION["mensaje"] = "Usuario o contraseña incorrectos.";
                $_SESSION["mensaje_tipo"] = "danger";
            }
        } else {
            $_SESSION["mensaje"] = "Debes ingresar un usuario.";
            $_SESSION["mensaje_tipo"] = "danger";
        }
    } catch (mysqli_sql_exception $e) {
        $_SESSION["mensaje"] = "Error: " . $e->getMessage();
        $_SESSION["mensaje_tipo"] = "danger";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column vh-100">
    <?php include_once "../includes/encabezado.php"; ?>
    <div class="container d-flex align-items-center justify-content-center flex-grow-1">
        <div class="card w-50">
            <div class="card-body">
                <h5 class="card-title text-center mb-4">Iniciar Sesión</h5>
                <!-- Mostrar mensaje -->
                <?php include_once "../includes/mensaje.php"; ?>
                <form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST">
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingresa tu usuario">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa tu contraseña">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>