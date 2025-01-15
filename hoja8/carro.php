<?php

class Carrito{
    public $productos = [];
    

    public function agregarProducto(){
        $nombre = readline("Nombre: ");
        $precio = readline("Precio: ");
        $cantidad = readline("Cantidad: ");
        
        $this->productos[] = [$nombre, $precio, $cantidad];
    }
    public function quitarProduto($nombre){
        $contador = 0;
        foreach($this->productos as $producto){
            if($producto[0] == $nombre){
                unset($this->productos[$contador]);
            }
            $contador++;
        }
        $this->productos = array_values($this->productos);
    }
    public function mostrarDetalleCarrito(){
        foreach ($this->productos as $i){
            echo "\n" . json_encode($i) . "\n";
        }
    }
    public function controlador(){
        $accion = 0;
        while($accion != 4){
            $accion = readline("\n| 1: agregar producto \n| 2: quitar producto \n| 3: Detalles carro \n| 4: Salir");
            switch($accion){
                case 1:
                    $this->agregarProducto();
                    break;
                case 2:
                    $nombre = readline("Nombre del producto a eliminar: ");
                    $this->quitarProduto($nombre);
                    break;
                case 3:
                    
                    $this->mostrarDetalleCarrito();
                    break;
            }
        }
       
    }
}

$carro = new Carrito();
$carro->controlador();
