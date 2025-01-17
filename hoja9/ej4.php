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

}
class Coche extends Vehiculo{
    private $combustible;

    public function __construct($marca, $modelo, $combustible){
        parent::__construct($marca, $modelo);
        $this->combustible = $combustible;
    }
    public function mostrarDetalles(){
        echo "Marca: $this->marca | Modelo: $this->modelo | Combustible: $this->combustible";
    }
}