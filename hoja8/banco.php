<?php

class CuentaBancaria {
    public $titular;
    public $saldo;
    public $tipoDeCuenta;

    public function depositar($cantidad){
        $this->saldo =+ $cantidad;
    }
    public function retirar($cantidad){
        $this->saldo =- $cantidad;
    }
    public function mostrarInfo(){
        return "-Titular: $this->titular \n-Saldo: $this->saldo \n-Tipo de cuenta: $this->tipoDeCuenta\n";
    }
}
$cuenta1 = new CuentaBancaria();
$cuenta1->titular = readline("Escribe el titular de la cuenta: ");
$cuenta1->saldo = readline("Escribe el saldo de la cuenta: ");
$cuenta1->tipoDeCuenta = readline("Escribe el tipo de cuenta: ");



while($accion != 4){
    $accion = readline("¿Que acción desea realizar?\nRetirar: 1\nDepositar: 2\nMostrar información: 3\nSalir: 4 \n\r");
    switch($accion){
        case 1:
            $cantidad = readline("¿Cuanto quieres retirar?: ");
            
            try{
                if($cantidad > $cuenta1->saldo){
                    throw new Exception("No puedes retirar más dinero del que hay");
                }
                $cuenta1->retirar($cantidad);
            }catch(Exception $e){
                echo "Error: " . $e->getMessage(); 
            }
            
            break;
        case 2:
            $cantidad = readline("¿Cuanto quieres depositar?: ");
            $cuenta1->depositar($cantidad);
            break;
        case 3:
            echo $cuenta1->mostrarInfo();
            break;
    }
}


