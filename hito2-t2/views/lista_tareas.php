<?php
session_start(); /* aqui mantenemos la sesion iniciada */

if (!isset($_SESSION['usuario'])) { /* si la sesion no tiene usuario nos llevará al login, para poder iniciar sesion */
    header("Location: ../sesion/login.php");
    exit();
}

require_once "../views/encabezado.php";
require_once "../controller/controller.php";
try{
    $controller = new User();
    $tasks = $controller->obtenerTareas($_SESSION['usuario']); /* le damos el valor del usuario atraves de la sesion */
}catch (mysqli_sql_exception $e){
    echo "<div class='alert alert-danger'>" . "Error: " . $e->getMessage() . "</div>"; 
}
$id = $_GET["id"] ?? null;
$accion = $_GET["accion"] ?? null;


if($_SERVER["REQUEST_METHOD"] === "POST" && $accion == "actualizar"){ /* si recibe un metodo post y además la accion get es actualizar, actualizara el estado al que este seleccionado */
    $estado = $_POST["estado"] ?? null;
    try{
        $controller = new User();
        $controller->actualizarEstado($id, $estado);
        header("Location: lista_tareas.php");
    }catch (mysqli_sql_exception $e){
        echo "<div class='alert alert-danger'>" . "Error: " . $e->getMessage() . "</div>"; 
    }
}

if($accion == "eliminar"){ /* si la accion get es eliminar, se eliminara la tarea que se ha seleccionado */
    try{
        $controller = new User();
        $controller->eliminarTareas($id);
        echo "<h1>hola</h1>";
        header("Location: lista_tareas.php");
    }catch (mysqli_sql_exception $e){
        echo "<div class='alert alert-danger'>" . "Error: " . $e->getMessage() . "</div>"; 
    }
}



?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de tareas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Tareas</h1>
        <table class="table table-striped table-bordered">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task): ?>
                    <tr class="text-center">
                        <td><?= $task['id_task'] ?></td>
                        <td><?= $task['name_task'] ?></td>
                        <td><?= $task['description_task'] ?></td>
                        <td><?= $task['state_task'] ?></td>
                        <td>
                            <form action="lista_tareas.php?id=<?= $task['id_task']?>&accion=actualizar" method="POST"> <!-- creamos un form para poder enviar la informacion por el POST -->
                                <select class="form-control m-2" name="estado" id="estado">
                                    <option value="pendiente">Pendiente</option>
                                    <option value="completada">Completada</option>
                                </select>
                                <button type="submit"  class="btn btn-primary form-control m-2">Actualizar</button>
                            </form>
                            <a href="lista_tareas.php?id=<?= $task['id_task'] ?>&accion=eliminar" class="btn btn-danger btn-sm form-control m-2"
                                onclick="return confirm('¿Estás seguro de que deseas eliminar la tarea?');"> <!-- con el onclick haremos que salga una alerta para confirmar la accion a realizar -->
                                <i class="bi bi-trash"></i> Eliminar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="new_task.php" class="btn btn-success mb-3">Agregar una nueva tarea</a>
    </div>
</body>

</html>