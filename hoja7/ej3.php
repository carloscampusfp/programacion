<?php
class Animal {
    public $especie;

    public function __construct($especie){
        $this->especie = $especie;
    }
    public function emitirSonido(){
        echo "El animal $this->especie dice: muuu\n";
    }
}
class Perro extends Animal {
    public $raza;

    public function __construct($especie, $raza){
        parent::__construct($especie);
        $this->raza = $raza;
    }
    public function emitirSonido(){
        echo "El animal $this->especie de raza $this->raza dice: muuu\n";
    }
}

$animal = new Animal('perro');
$perro = new Perro('perro', 'pitbull');
$animal->emitirSonido();
$perro->emitirSonido();