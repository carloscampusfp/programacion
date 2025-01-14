<?php
class Empleado{
    public $nombre;
    public $sueldo;
    public $anosExperiencia;

    public function __construct($nombre, $sueldo, $anosExperiencia){
        $this->nombre = $nombre;
        $this->sueldo = $sueldo;
        $this->anosExperiencia = $anosExperiencia;

    }
    public function calcularBonus(){
        $bonus = 0;
        for($i = 0; $i <= $this->anosExperiencia /2 ; $i++){
            $bonus++;
        }
        echo "Hay un total de $bonus bonus del cinco porciento y el sueldo más el bonus es de: " . $this->sueldo += $bonus * (($this->sueldo * 5) /100);
    }
    public function mostrarDetalles(){
        echo "Nombre: $this->nombre | Sueldo: $this->sueldo | Años de experiencia: $this->anosExperiencia";
    }
}

class Consultor extends Empleado{
    public $horasPorProyecto;

    public function __construct($nombre, $sueldo, $anosExperiencia, $horasPorProyecto){
        parent::__construct($nombre, $sueldo, $anosExperiencia);
            $this->horasPorProyecto = $horasPorProyecto;  
    }
    public function calcularBonus(){
        $bonus = 0;
        for($i = 0; $i <= $this->anosExperiencia /2 ; $i++){
            $bonus++;
        }if($this->horasPorProyecto > 100){
            $bonus++;
        }
        echo "\nHay un total de $bonus bonus del cinco porciento y el sueldo más el bonus es de: " . $this->sueldo += $bonus * (($this->sueldo * 5) /100) . "\n";
    }
}

$empleado1 = new Empleado('Carlos', 2000, 10);
$consultor1 = new Consultor('Pepe', 3000, 20, 150);

$empleado1->calcularBonus();
$consultor1->calcularBonus();