<?php
require_once "./encabezado.html";
require_once "../controlador/SociosController.php";

$id = $_GET["id"] ?? null;
$controller = new SociosController();
$socio = $controller->obtenerSocioPorId($id);

if ($id !== null && $socio !== null) {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nombre = $_POST["nombre"] ?? null;
        $apellido = $_POST["apellido"] ?? null;
        $email = $_POST["email"] ?? null;
        $telefono = $_POST["telefono"] ?? null;
        $fecha_nacimiento = $_POST["fecha_nacimiento"] ?? null;
        try {
            $controller->actualizarSocio($id, $nombre, $apellido, $email, $telefono, $fecha_nacimiento);
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) {
                echo "<div class='alert alert-danger'>El correo electrónico ya está registrado.</div>";
            } else {
                echo "<div class='alert alert-danger'>" . "Error: " . $e->getMessage() . "</div>";
            }
        }
    }
} else {
    echo "Socio no encontrado.";
    echo "<br><a href='../vista/lista_socios.php'>Volver</a>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Socio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Editar Socio</h1>
        <form action="editar_socio.php?id=<?php echo htmlspecialchars($id); ?>" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($socio['nombre']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido:</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo htmlspecialchars($socio['apellido']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($socio['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono:</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" value="<?php echo htmlspecialchars($socio['telefono']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo htmlspecialchars($socio['fecha_nacimiento']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="lista_socios.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>

</html>