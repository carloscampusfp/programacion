<?php

class Libro {
    public $titulo;
    public $autor;
    public $paginas;

    public function __construct($titulo, $autor, $paginas)
    {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->paginas = $paginas;
    }

    public function mostrarInfo($nombreObjeto){
        echo "Titulo: $nombreObjeto->titulo \nAutor: $nombreObjeto->autor \nNúmero de páginas: $nombreObjeto->paginas \n";
    }
}

$libro1 = new Libro('La utilidad de lo inutil', 'Liria', '200');
$libro1->mostrarInfo($libro1);

$libro2 = new Libro('El piloto que lanzo la bomba de hiroshima', 'Albert Camus', '250');
$libro2->mostrarInfo($libro2);

class Circulo {
    public $radio;

    public function __construct($radio)
    {
        $this->radio = $radio;
    }
    public function calcularArea($circulo){
        return "El área de tu circulo es de: " . pi()*$this->radio**2 . "\n";
    }
}

$circulo = new Circulo(20);
echo $circulo->calcularArea($circulo);


class Vehiculo {
    public $marca;

    public function __construct($marca){
        $this->marca = $marca;
    }

    public function encender(){
        echo "El coche $this->marca está encendido\n";
    }
}

class Coche extends Vehiculo {
    public $modelo;
    
    public function __construct($marca, $modelo)
    {
        parent::__construct($marca);
        $this->modelo = $modelo;
    }
    public function encender(){
        echo "El coche $this->marca modelo $this->modelo está encendido\n";
    }
}

$vehiculo1 = new Vehiculo("ford");
$coche1 = new Coche('seat', 'leon');
$vehiculo1->encender();
$coche1->encender();

class Empleado {
    public $nombre;
    public $sueldo;

    public function __construct($nombre, $sueldo){
        $this->nombre = $nombre;
        $this->sueldo = $sueldo;
    }
    public function mostrarDetalles(){
        echo "Nombre: $this->nombre \nSueldo: $this->sueldo \n";
    }
}
class Gerente extends Empleado {
    public $departamento;

    public function __construct($nombre, $sueldo, $departamento){
        parent::__construct($nombre, $sueldo);
        $this->departamento = $departamento;
    }
    public function mostrarDetalles(){
        echo "Nombre: $this->nombre \nSueldo: $this->sueldo \nDepartamento: $this->departamento \n";
    }
}

$empleado1 = new Empleado("Carlos", "500");
$gerente1 = new Gerente("Miguel", "1000", "contabilidad");

$empleado1->mostrarDetalles();
$gerente1->mostrarDetalles();

class Calculadora {
    public $num1;
    public $num2;
    public $operador;

    public function __construc($num1, $num2, $operador){
        $this->num1 = $num1;
        $this->num2 = $num2;
        $this->operador = $operador;
    }
    
    public function sumar(){
        echo $this->num1 + $this->num2;
    }
    public function restar(){
        echo $this->num1 - $this->num2;
    }
    public function multiplicar(){
        echo $this->num1 * $this->num2;
    }
    public function dividir(){
        if ($this->num2 == 0){
            throw new Exception("No puedes dividir entre 0");
        }
        else{
            echo $this->num1 / $this->num2;
        }
    }

    public function calcular(){
        switch ($this->operador){
            case 1:
                $this->sumar();
                break;
            case 2:
                $this->restar();
                break;
            case 3:
                $this->multiplicar();
                break;
            case 4:
                try{
                    $this->dividir();
                    } catch(Exception $e){
                        echo "Error: " . $e->getMessage();
                    } 
                break;
    }
    }
}
$num1 = readline("Inserta un numero: ");
$num2 = readline("Inserta un numero: ");
$operador = readline("-1: sumar \n-2: restar \n-3: multiplicar \n-4: dividir\n");
$calculo1 = new Calculadora($num1, $num2, $operador);

