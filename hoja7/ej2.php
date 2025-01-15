<?php
class Rectangulo {
    public $base;
    public $altura;

    public function __construct($base, $altura){
        $this->base = $base;
        $this->altura = $altura;
    }
    public function calcularArea(){
        return $this->base * 2 + $this->altura * 2;
    }
}

$rectangulo = new Rectangulo(10 , 5);

echo $rectangulo->calcularArea();