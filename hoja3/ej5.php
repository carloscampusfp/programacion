<?php
$valor = readline("Cuantos grados son: ");
$formato = strtolower(readline("A que formato lo quieres convertir: "));

ini_set("log_errors" , 1);
ini_set("error_log" , "hoja3/errores.log");
if ($formato != "c" && $formato != "f"){
    error_log("Error, formato incorrecto");
}
function conversor($valor , $formato){
    if ($formato == "c"){
        return ($valor - 32) * 5/9;
    }
    elseif($formato == "f"){
        return ($valor * 9/5) + 32;
    }
} 

echo conversor($valor , $formato);
?>