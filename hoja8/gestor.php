<?php

class Tarea{
    public $nombre;
    public $descripcion;
    public $fechaLimite;
    public $estado;

    public function __construct($nombre, $descripcion, $fechaLimite, $estado){
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->fechaLimite = $fechaLimite;
        $this->estado = $estado;
    }

    public function marcarCompletada(){
        $this->estado = "completada";
    }

    public function editarDescripcion(){
        $this->descripcion = readline("Escribe aqui la nueva descripción: ");
    }

    public function mostrarTarea(){
        echo "Nombre: $this->nombre | Descripción: $this->descripcion | Fecha límite: $this->fechaLimite | Estado: $this->estado\n";
    }
}

$tarea1 = new Tarea('Pasear al perro', 'Has de pasear al perro 1 hora', '20 de marzo', 'incompleta');
$tarea2 = new Tarea('Lavar los platos', 'Lavar los platos de todos', '24 de marzo', 'incompleta');
$lista = [$tarea1, $tarea2];

while (true){
    $contador = 0;
    foreach($lista as $tarea){
        $contador ++;
        echo "-$contador: $tarea->nombre\n";
    }
    $seleccionarTarea = readline("selecciona la tarea (para salir escriba 0): ");
    if($seleccionarTarea == 0){
        break;
    }
    $accion = readline("1: editar descripción | 2: marcar como completada | 3: mostrar detalles\n");
    if($accion == 1){
        $lista[$seleccionarTarea-1]->editarDescripcion();
    }
    elseif($accion == 2){
        $lista[$seleccionarTarea-1]->marcarCompletada();
    }
    elseif($accion == 3){
        $lista[$seleccionarTarea-1]->mostrarTarea();
    }

}