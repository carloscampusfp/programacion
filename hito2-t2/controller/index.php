<?php
require_once "../views/encabezado.php";
require_once "./controller.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $nombre = $_POST["nombre"] ?? null;
    $correo = $_POST["correo"] ?? null;
    $password = $_POST["password"] ?? null;
    try{
        $controller = new User();
        $controller->singUp($nombre, $correo, $password);
    }catch (mysqli_sql_exception $e){
        
        if($e->getCode() == 1062){
            echo "<div class='alert alert-danger'>El correo electrónico ya está registrado.</div>";
        }else{
            echo "<div class='alert alert-danger'>" . "Error: " . $e->getMessage() . "</div>"; 
        }
    }

}

session_start();


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Registrar usuario</h1>
        <form action="index.php" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input type="text" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div>
                <label for="cookies" class="form-check-label">Autorizar cookies</label>
                <input type="checkbox" class="form-check-input" id="cookies" name="cookies" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar usuario</button>
            <a href="../sesion/login.php" class="btn btn-secondary">Iniciar sesion</a>
        </form>
    </div>
</body>

</html>