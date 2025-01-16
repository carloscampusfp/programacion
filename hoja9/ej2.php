<?php

class CuentaBancaria{
    private $titular;
    private $saldo;
    private $tipoCuenta;

    public function __construct($titular, $tipoCuenta){
        $this->titular = $titular;
        $this->saldo = 0;
        $this->tipoCuenta = $tipoCuenta;

    }
    public function depositar($cantidad){
        $this->saldo += $cantidad;
        echo "Se ha depositado un total de $cantidad € y te queda un total de $this->saldo € en la cuenta\n";
    }
    private function verificarSaldo($cantidad){
        return $cantidad <= $this->saldo;
    }
    public function retirar($cantidad){
        try{
            if($this->verificarSaldo($cantidad) == False){
                throw new Exception('no puedes retirar más de lo que hay en el saldo');
            }
            $this->saldo -= $cantidad;
            echo "\nSe han retirado un total de $cantidad €, te queda un saldo de $this->saldo €\n";
        }catch (Exception $e){
            echo "Error: " . $e->getMessage();
        }
        
    } 
}

$cuenta = new CuentaBancaria('Carlos', 'normal');
$operar = 0;
while($operar != 3){
    $operar = readline("\n1: depositar | 2: retirar | 3: salir\n");
    if($operar == 1){
        $cantidad = readline("Que cantidad deseas depositar: ");
        $cuenta->depositar($cantidad);
    }
    elseif($operar == 2){
        $cantidad = readline("Que cantidad deseas retirar: ");
        $cuenta->retirar($cantidad);
    }
}