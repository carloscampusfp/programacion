<?php
$email = readline("Escribe tu email: ");
ini_set("log_errors" , 1);
ini_set("error_log" , "hoja3/errores.log");

function validar($email){
    if (filter_var($email , FILTER_VALIDATE_EMAIL)){
        return "El email es valido";
    }
    else{
        echo "El email que se ha escrito no es válido";
        error_log("El email $email es incorrecto");
    }
}
echo validar($email)
?>