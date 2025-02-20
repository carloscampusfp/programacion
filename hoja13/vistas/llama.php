<?php

use function PHPSTORM_META\type;

require_once __DIR__ . '\..\modelo\model.php';


$message = "Aún no se ha ingresado una receta."; // Valor por defecto

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['recetaNombre'])) {
    $receta = htmlspecialchars($_POST['recetaNombre']); // Sanitizar entrada

    // Configuración de la API de LM Studio
    $puerto = '1234';
    $url = "http://localhost:$puerto/v1/chat/completions";

    // Datos para la API
    $datos = array(
        "model" => "llama-3.2-1b-instruct",
        "messages" => array(
            array("role" => "system", "content" => "Responde siempre en español"),
            array("role" => "user", "content" => "Dame únicamente los ingredientes de la receta de $receta")
        ),
        "temperature" => 0.7,
        "max_tokens" => -1,
        "stream" => false
    );

    // Convertir el array a JSON
    $jsonDatos = json_encode($datos);

    // Inicializar cURL
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDatos);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($jsonDatos)
    ));

    // Ejecutar la solicitud
    $respuesta = curl_exec($ch);

    if (curl_errno($ch)) {
        $message = 'Error en cURL: ' . curl_error($ch);
    } else {
        $data = json_decode($respuesta, true);
        if (isset($data['choices'][0]['message']['content'])) {
            $message = nl2br(htmlspecialchars($data['choices'][0]['message']['content'])); //el nl2br añade los saltos de linea dados por la api
        } else {
            $message = "No se recibió una respuesta válida.";
        }
    }

    $recetaNueva = new Receta();
    $recetaNueva->crearReceta($receta, $message);

    curl_close($ch); 

}

