<?php
require_once "./controlador.php";
require_once "../paginas/encabezado.html";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"] ?? null;
    try {
        $controlador = new Usuario();
        $datos = $controlador->detallarPrecio($id);

        if (!$datos) {
            echo "<div class='alert alert-warning'>No se encontraron datos para el usuario con ID $id.</div>";
            return;
        }

        // Verificamos si 'paquete' ya es un array o si necesita convertirse
       
        $paquetes = explode(",", $datos["paquete"]); // Convertir de cadena a array ya uq emas tarde vamos a realizar un buclee para mostrar los paquetes
        

        // Simulación de precios de paquetes
        $preciosPaquetes = [
            "Infantil" => 4.99,
            "Cine" => 7.99,
            "Deporte" => 6.99
        ];

        $precioPlan = [
            "basico" => 9.99,
            "estandar" => 13.99,
            "premium" => 17.99
        ];

        echo "<div class='container mt-4'>";
        echo "<h3 class='mb-3'>Detalles del paquete del usuario (mensualmente)</h3>";

        echo "<table class='table table-striped'>";
        echo "<thead class='thead-dark'><tr><th>Detalle</th><th>Valor</th></tr></thead>";
        echo "<tbody>";
        echo "<tr><th>Nombre</th><td>{$datos['nombre']}</td></tr>";
        echo "<tr><th>Plan</th><td>{$datos['plan']} - <strong>{$precioPlan[$datos["plan"]]}€</strong></td></tr>";
        echo "<tr><th>Duración</th><td>{$datos['duracion']}</td></tr>";
        

        // Mostrar los paquetes y sus precios
        echo "<tr><th>Paquetes</th><td>";
        echo "<ul class='list-group'>";
        $totalPaquetePrecio = 0;
        foreach ($paquetes as $paquete) {
            $paquete = trim($paquete); // Quitar espacios
            $precioPaquete = $preciosPaquetes[$paquete] ?? 0; // Buscar precio, si no existe asigna 0
            $totalPaquetePrecio += $precioPaquete;
            echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
            echo "$paquete <span class=' badge-primary badge-pill'>{$precioPaquete}€</span>";
            echo "</li>";
        }
        echo "</ul>";
        echo "</td></tr>";

        // Mostrar el total de los paquetes
        echo "<tr class='table-warning'><th>Total Paquetes</th><td><strong>{$totalPaquetePrecio}€</strong></td></tr>";

        // Mostrar el total general (Plan + Paquetes)
        if($datos["duracion"] === "anual"){
            $totalGeneral = ($datos["precio"])/12;
        }else{
            $totalGeneral = ($datos["precio"]);
        }

        
        echo "<tr class='table-success'><th>Total General</th><td><strong>{$totalGeneral}€</strong></td></tr>";

        echo "</tbody>";
        echo "</table>";
        echo "</div>";

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
    <title>Precios detallados</title>
</head>
<body>
<div class="container mt-5">
        <h1 class="text-center mb-4 text-primary">Precios detallados</h1>
        <form action="detallesPrecio.php" method="POST" class="p-4 shadow-lg rounded-4 bg-light">
            <!-- Campo de ID -->
            <div class="mb-3">
                <label for="id" class="form-label">Id</label>
                <input type="number" class="form-control" id="id" name="id" placeholder="Escribe el id que identifica al usuario" required>
            </div>
            <!-- Botón de Enviar -->
            <button type="submit" class="btn btn-primary w-100">Detallar precio</button>
        </form>
    </div>
</body>
</html>
