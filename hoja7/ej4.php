<?php
class Producto {
    public $nombre;
    public $precio;

    public function __construct($nombre, $precio) {

        $this->nombre = $nombre;
        $this->precio = $precio;
    }
    public function mostrarDetalles(){
        return "Nombre: $this->nombre \nPrecio: $this->precio\n";
    }
}
class Electrodomestico extends Producto {
    public $consumo;
    
    public function __construct($nombre, $precio, $consumo){
        parent::__construct($nombre, $precio);
        $this->consumo = $consumo;
    }
    public function mostrarDetalles(){
        return "Nombre: $this->nombre \nPrecio: $this->precio \nConsumo: $this->consumo\n";
    }
}

$producto = new Producto('champú', 5);
echo $producto->mostrarDetalles();

$electrodomestico = new Electrodomestico('lavadora', 300, 3);
echo $electrodomestico->mostrarDetalles();
