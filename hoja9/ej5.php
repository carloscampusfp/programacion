<?php
class Empleado{
    private $nombre;
    private $sueldo;
    private $puesto;

    public function __construct($nombre, $sueldo, $puesto){
        $this->nombre = $nombre;
        $this->sueldo = $sueldo;
        $this->puesto = $puesto;
    }
    public function setSueldo($nuevoSueldo){
        $this->sueldo = $nuevoSueldo;
    }
    public function getSueldo(){
        return $this->sueldo;
    }
    public function revisarEmpleado(/* Empleado $empleado */){ 
        echo "-El nombre del empleado es $this->nombre y su puesto es $this->puesto\n" ;
    }
}

class Manager extends Empleado{
    private $departamento;

    public function __construct($nombre, $sueldo, $departamento){
        parent::__construct($nombre, $sueldo, 'manager');
        $this->departamento = $departamento;
        
    }
}

$managers = [
    new Manager('Pedro', 2000, 'informatica')
];

$empleados = [
    new Empleado('Paula', 1500, 'dependiente'),
    new Empleado('Miguel', 1700, 'tecnico'),
    new Empleado('David', 3000, 'programador')
];

foreach($empleados as $empleado){
    $empleado-> revisarEmpleado();
}

foreach($managers as $manager){
    $manager-> revisarEmpleado();
}