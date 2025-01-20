<?php
require_once '../controlador/SociosController.php';


$nombre = $apellido = $email = $telefono = $fecha_nacimiento = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoge los datos del formulario
    $nombre = htmlspecialchars(trim($_POST['nombreadd'] ?? ''));
    $apellido = htmlspecialchars(trim($_POST['apellidoadd'] ?? ''));
    $email = htmlspecialchars(trim($_POST['emailadd'] ?? ''));
    $telefono = htmlspecialchars(trim($_POST['telefonoadd'] ?? ''));
    $fecha_nacimiento = htmlspecialchars(trim($_POST['fechaadd'] ?? ''));

    $controller = new SociosController();
    $socios = $controller->agregarSocio($nombre, $apellido, $email, $telefono, $fecha_nacimiento);
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Alta socio</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>


    <body>
        <form method = 'post' action = ''>
        
        <div class="form-group col-md-6 align-items-center">
            <label for="inputEmail4">Nombre</label>
            <input type="text" class="form-control" name="nombreadd" placeholder="Nombre">
        </div>
        <div class="form-group col-md-6">
            <label for="inputPassword4">Apellido</label>
            <input type="text" class="form-control" name="apellidoadd" placeholder="Apellido">
        </div>
        <div class="form-group col-md-6">
            <label for="inputAddress">Email</label>
            <input type="email" class="form-control" name="emailadd" placeholder="email@email.com">
        </div>
        <div class="form-group col-md-6">
            <label for="inputAddress2">Teléfono</label>
            <input type="text" class="form-control" name="telefonoadd" placeholder="+34 .....">
        </div>
        <div class="form-group col-md-6">
            <label for="inputAddress2">Fecha de nacimiento</label>
            <input type="date" class="form-control" name="fechaadd" placeholder="Fecha de nacimineto">
        </div>
        <button type="submit" class="btn btn-primary">Agregar socio</button>
        </form>
    </body>
</html>