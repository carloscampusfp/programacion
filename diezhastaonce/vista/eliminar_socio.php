<?php
require_once "./encabezado.html";
require_once "../controlador/SociosController.php";

if (isset($_GET["id"])) {
    $controller = new SociosController();
    $controller->eliminarSocio($_GET["id"]);
}

header("Location: lista_socios.php");
exit();