<?php
$num = readline("Escribe un numero: ");


function tablaMulti($num){
    ini_set("log_errors" , 1);
    ini_set("error_log" , "hoja3/errores.log");

    try{
        if($num < 0){
            throw new Exception("Has introducido un numero negativo, recuerda que el número ha de ser positivo!!");
            error_log("Has introducido un numero negativo");
        }
        for ($i = 1 ; $i <= 10 ; $i++){
            echo "$num * $i = " . $num * $i . "\n";
        }
    }catch(Exception $e){
        echo $e -> getMessage();
    }
}
tablaMulti($num)

?>