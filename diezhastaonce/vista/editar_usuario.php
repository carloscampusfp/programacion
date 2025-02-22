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
$controller = new UsuariosController();
$id_usuario = $_GET["id"] ?? null;
$usuario = null;

if ($id_usuario !== null) {
    $usuario = $controller->obtenerUsuarioPorId($id_usuario);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_usuario = $_POST["id_usuario"] ?? null;
    $usuarioNombre = $_POST["usuario"] ?? null;
    $rol = $_POST["rol"] ?? null;
    $password = $_POST["password"] ?? null;

    if ($id_usuario !== null && $usuarioNombre !== null && $rol !== null) {
        try {
            $controller->editarUsuario($id_usuario, $usuarioNombre, $rol, $password);
            $_SESSION["mensaje"] = "Usuario editado con éxito.";
            $_SESSION["mensaje_tipo"] = "success";
            // Actualizar vista
            $usuario = $controller->obtenerUsuarioPorId($id_usuario);
        } catch (mysqli_sql_exception $e) {
            $_SESSION["mensaje"] = "Error: " . $e->getMessage();
            $_SESSION["mensaje_tipo"] = "danger";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php include_once "../includes/encabezado.php"; ?>
    <div class="container mt-5">
        <h1 class="mb-4">Editar Usuario</h1>
        <!-- Mostrar mensaje -->
        <?php include_once "../includes/mensaje.php"; ?>
        <form action="<?php echo $_SERVER["PHP_SELF"] . "?id=" . htmlspecialchars($id_usuario); ?>" method="POST">
            <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario']; ?>">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario['usuario']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol:</label>
                <select class="form-select" id="rol" name="rol" required>
                    <option value="admin" <?php echo $usuario['rol'] === 'admin' ? 'selected' : ''; ?>>Administrador</option>
                    <option value="user" <?php echo $usuario['rol'] === 'user' ? 'selected' : ''; ?>>Usuario</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Nueva Contraseña (dejar en blanco para no cambiar):</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="lista_usuarios.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>

</html>