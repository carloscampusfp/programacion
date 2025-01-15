<?php

class Personaje{
    public $nombre;
    public $nivel;
    public $puntosVida;
    public $puntosAtaque;
   
    public function __construct($nombre, $nivel, $puntosVida, $puntosAtaque){
        $this->nombre = $nombre;
        $this->nivel = $nivel;
        $this->puntosVida = $puntosVida;
        $this->puntosAtaque = $puntosAtaque;
        
    }
    public function atacar($objetivo){
        $objetivo->puntosVida -= $this->puntosAtaque;

    }
    public function curarse(){
        if($this->puntosVida < 100){ #hago que se cure la mitad de lo que le queda para llegar al maximo de vida
            $this->puntosVida += (100 - $this->puntosVida) / 2;
        }
    }
    public function subirNivel(){
        $this->nivel++;
        $this->puntosVida += 20;
        $this->puntosAtaque += 20;
    }
    
    public function partida(){
        
        $rondas = readline("Cuantas rondas quieres jugar: ");
        for($i = 0 ; $i <= $rondas * 2 ; $i++){
            echo "Es el turno de $this->nombre";
            $jugada = readline("1: subir nivel | 2: atacar | 3: curarse 50    ");
            switch($jugada){
                case 1:
                    $this->subirNivel();
                    break;
                case 2:
                    $this->atacar($jugador2);  
                    break;
                case 3:
                    $this->curarse();
                    break;
                }
            echo "Es el turno de $jugador2->nombre";
            $jugada = readline("1: subir nivel | 2: atacar | 3: curarse 50   ");
            switch($jugada){
                case 1:
                    $jugador2->subirNivel();
                    break;
                case 2:
                    $jugador2->atacar($this);
                    break;
                case 3:
                    $jugador2->curarse();
                    break;
            }
            if($this->puntosVida <= 0){
                echo "Victoria para $jugador2->nombre";
                break;
            }
            elseif($jugador2->puntosVida <= 0){
                echo "Victoria para $this->nombre";
                break;
            }
        }
    }
}   

echo "Bienvenido a al juego\n";

$jugador1 = 0;
$nombre1 = readline("Inserte nombre del jugador 1: ");
$jugador1 = new Personaje($nombre1, 1, 100, 50);

$jugador2 = 0;
$nombre2 = readline("Inserte nombre del jugador 2: ");
$jugador2 = new Personaje($nombre2, 1, 100, 50);

$jugador1->partida();