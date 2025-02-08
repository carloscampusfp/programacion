<?php
session_start();
require_once "../views/encabezado.php";
require_once "../controller/controller.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $correo = $_POST["correo"] ?? null;
    $password = $_POST["password"] ?? null;
    try{
        $controller = new User();
        if($controller->logIn($correo, $password)){ /* con esta funcion verificamos que la contraseña y el correo coincidan correctamente */
            $_SESSION['usuario'] = $correo;
            header("Location: ../views/lista_tareas.php");
            exit();
        }else{
            echo "<div class='alert alert-danger'>Usuario o contraseña incorrectos.</div>";
        }
    }catch (mysqli_sql_exception $e){
        echo "<div class='alert alert-danger'>" . "Error: " . $e->getMessage() . "</div>"; 
    }

}





?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Iniciar sesión</h1>
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input type="text" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Iniciar sesión</button>
            <a href="../controller/index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>

</html>