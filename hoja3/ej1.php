<?php
$num1 = readline("Escribe el primer número: ");
$num2 = readline("Escribe el segundo número: ");

echo "-1: sumar \n-2: restar \n-3: multiplicar \n-4: dividir \n";
$operador = readline("Escribe que operador es el que deseas utilizar: ");

function operar($num1, $num2, $operador){
    if ($operador == 1){
        return $num1 + $num2;
    }
    elseif ($operador == 2){
        return $num1 - $num2;
    }
    elseif ($operador == 3){
        return $num1 * $num2;
    }
    elseif ($operador == 4){
        if ($num2 == 0){
            throw new Exception("No se puede dividir un número entre 0");
        }
        return $num1 / $num2;
    }
}

try{
    echo operar($num1, $num2 , $operador);
} catch(Exception $e){
    echo "Error: " . $e->getMessage();
}

?>