<?php
class Persona {
    public $persona;
    public $edad;
    public $genero;

    public function __construct($persona, $edad, $genero){
        $this->persona = $persona;
        $this->edad = $edad;
        $this->genero = $genero;
    }
    public function presentar(){
        echo "-Persona: $this->persona \n-Edad: $this->edad \n-Genero: $this->genero";
    }
}

$persona = new Persona("Carlos", '19', 'masculino');
$persona->presentar();


