<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
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
    header("Refresh: 3; URL=../../index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once "../../controlador/UsuariosController.php";
    $controller = new UsuariosController();
    $usuario = $_POST["usuario"] ?? null;
    $password = $_POST["password"] ?? null;
    $rol = $_POST["rol"] ?? null;

    if ($usuario !== null && $password !== null && $rol !== null) {
        try {
            $controller->registrarUsuario($usuario, $password, $rol);
            $_SESSION["mensaje"] = "Usuario registrado con éxito.";
            $_SESSION["mensaje_tipo"] = "success";
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) {
                $_SESSION["mensaje"] = "El usuario ya está registrado.";
                $_SESSION["mensaje_tipo"] = "danger";
            } else {
                $_SESSION["mensaje"] = "Error: " . $e->getMessage();
                $_SESSION["mensaje_tipo"] = "danger";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Alta de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php include_once "../includes/encabezado.php"; ?>
    <div class="container mt-5">
        <h1 class="mb-4">Alta de Usuario</h1>
        <!-- Mostrar mensaje -->
        <?php include_once "../includes/mensaje.php"; ?>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol:</label>
                <select class="form-select" id="rol" name="rol" required>
                    <option value="">Seleccione un plan</option>
                    <option value="admin">Administrador</option>
                    <option value="user">Usuario</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Usuario</button>
            <a href="lista_usuarios.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>

</html>