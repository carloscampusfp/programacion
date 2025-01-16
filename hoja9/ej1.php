<?php

class Producto{
    private $nombre;
    private $precio;
    private $cantidad;

    public function __construct($nombre, $precio, $cantidad){
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function  getPrecio(){
        return $this->precio;
    }
    public function getCantidad(){
        return $this->cantidad;
    }
    public function calcularPrecioFinal(){
        $precioF = $this->getCantidad() * $this->getPrecio();
        echo "El precio final es de: $precioF €";
    }
}

class ProductoImportado extends Producto{
    public $impuestoAdicional;
    public function __construct($nombre, $precio, $cantidad, $impuestoAdicional){
        parent::__construct($nombre, $precio, $cantidad);
        $this->impuestoAdicional = $impuestoAdicional;
    }
    public function calcularPrecioFinal(){
        $precioF = $this->getCantidad() * $this->getPrecio() + $this->impuestoAdicional;
        echo "El precio final es de: $precioF €";
    }
}

$nombre = readline("Escribe el nombre del producto: ");
$importado = readline("¿Su producto es importado? si | no -> ");
$precio = readline("Escribe el precio del producto: ");
$cantidad = readline("Escribe la cantidad del producto: ");

if($importado == "si"){
    $producto = new ProductoImportado($nombre, $precio, $cantidad, ($precio*$cantidad)/10); #impuesto del 10%
}   
else{   
    $producto = new Producto($nombre, $precio, $cantidad);
}

$producto->calcularPrecioFinal();
