<?php

class Vehiculo{
    private $marca;
    private $modelo;

    public function __construct($marca, $modelo){
        $this->marca = $marca;
        $this->modelo = $modelo;
    }
    public function encender(){
        echo "El vehiculo está encendido";
    }
    public function getMarca(){
        return $this->marca;
    }
    public function getModelo(){
        return $this->modelo;
    }

}
class Coche extends Vehiculo{
    private $combustible;

    /* public function getValue() */

    public function __construct($marca, $modelo, $combustible){
        parent::__construct($marca, $modelo);
         $this->combustible = $combustible;
    }
    public function mostrarDetalles(){
        echo "Marca: " . $this->getMarca() . " | Modelo: " . $this->getModelo() . " | Combustible: $this->combustible";
    }
}


$coche1 = new Coche('ford', 'cmax', 'diesel');
$coche1->mostrarDetalles();
