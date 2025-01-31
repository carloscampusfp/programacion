<?php
require "../paginas/encabezado.html";
require_once "./controlador.php";


if($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"] ?? null;
    $nombre = $_POST["nombre"] ?? null;
    $apellidos = $_POST["apellidos"] ?? null;
    $correo = $_POST["correo"] ?? null;
    $edad = $_POST["edad"] ?? null;
    $plan = $_POST["plan"] ?? null;
    if(isset($_POST["paquete"]) && is_array($_POST["paquete"])){ #esto lo he escrito de esa manera, ya que al usar el implode (que por cierto lo que hace es pasar el array a string separandolo por comas) si no se rellenase ningun checkboz ocurriria un error grave
        $paquete = implode(", ", $_POST["paquete"]);
    }else{
        $paquete = null;
    }
    $duracion = $_POST["duracion"] ?? null;
    $precio = $_POST["precio"] ?? null; 
    try{
        $controlador = new Usuario();
        $controlador->actualizarUsuario($nombre, $apellidos, $correo, $edad, $plan, $paquete, $duracion, $precio, $id);
    } catch (mysqli_sql_exception $e) {
        echo "<div class='alert alert-danger'>" . "Error: " . $e->getMessage() . "</div>";
    }

}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Actualizar usuario</title>
</head>
<body>
<div class="container mt-5">
        <h1 class="text-center mb-4 text-primary">Actualizar usuario</h1>
        <form action="actualizar.php" method="POST" class="p-4 shadow-lg rounded-4 bg-light">

             <!-- Campo de ID -->
             <div class="mb-3">
                <label for="nombre" class="form-label">Id</label>
                <input type="number" class="form-control" id="id" name="id" placeholder="Excribe el id que identifica al usuario" required>
            </div>

            <!-- Campo de Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Carlos" required>
            </div>
            
            <!-- Campo de Apellidos -->
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Horcajada Moyano" required>
            </div>
            
            <!-- Campo de Correo -->
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" placeholder="correo@falso.com" required>
            </div>
            
            <!-- Campo de Edad -->
            <div class="mb-3">
                <label for="edad" class="form-label">Edad</label>
                <input type="number" class="form-control" id="edad" name="edad" required>
            </div>
            
            <!-- Selects de Plan y Duración -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="plan" class="form-label">Plan</label>
                    <select id="plan" name="plan" class="form-select" required>
                        <option value="basico">Básico (1 dispositivo)</option>
                        <option value="estandar">Estándar (2 dispositivos)</option>
                        <option value="premium">Premium (4 dispositivos)</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="duracion" class="form-label">Duración</label>
                    <select id="duracion" name="duracion" class="form-select" required>
                        <option value="mensual">1 mes</option>
                        <option value="anual">1 año</option>
                    </select>
                </div>
            </div>
            
            <!-- Checkboxes de Paquetes -->
            <div class="mb-3">
                <label for="paquete" class="form-label">Paquetes</label>
                <div>
                    <input type="checkbox" class="form-check-input me-2" id="infantil" name="paquete[]" value="Infantil"> 
                    <label for="infantil" class="form-check-label">Infantil</label><br>
                    
                    <input type="checkbox" class="form-check-input me-2" id="cine" name="paquete[]" value="Cine" > 
                    <label for="cine" class="form-check-label">Cine (Solo si es mayor de edad)</label><br>
                    
                    <input type="checkbox" class="form-check-input me-2" id="deporte" name="paquete[]" value="Deporte" > 
                    <label for="deporte" class="form-check-label">Deporte (Mayor de edad y plan anual)</label>
                </div>
            </div>
            
            <!-- Campo de Precio -->
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="text" class="form-control" id="precio" name="precio" readonly placeholder="Calculado automáticamente">
            </div>
            
            <!-- Botón de Enviar -->
            <button type="submit" class="btn btn-primary w-100">Añadir Usuario</button>
        </form>
    </div>
            
            
            <button type="submit" class="btn btn-primary" hidden>Guardar</button>
        </form>
    </div>
</body>
<script src="../javascript/main.js"></script>
</html>