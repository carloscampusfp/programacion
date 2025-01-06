<?php
$array = ["manzana" , "naranja" , "pera"];

function buscarValor($array , $valor){
    $contador = 0;
    foreach($array as $i){
        if ($i == $valor){
            
            return "El array esta en la posición " . $contador;
        }
        else{
            $contador ++;
        }
    }
}

function manejoErrores($nivel , $mensaje , $archivo , $linea){
echo "Ocurrio un error de nivel $nivel, en $archivo, en la línea $linea: $mensaje";
error_log("Error $mensaje en $archivo:$linea <br>" , 3 , "hoja3/errores.log");
}

set_error_handler("manejoErrores");
$valor = readline("Escribe que palabra deseas buscar dentro del array: ");

echo buscarValor($array , $valor);
echo $array;
?>