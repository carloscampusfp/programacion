<?php

class Personaje{
    public $nombre;
    public $nivel;
    public $puntosVida;
    public $puntosAtaque;
    #public static $contador = 0;

    public function __construct($nombre, $nivel, $puntosVida, $puntosAtaque){
        $this->nomnbre = $nombre;
        $this->nivel = $nivel;
        $this->puntosVida = $puntosVida;
        $this->puntosAtaque = $puntosAtaque;
        #self::$contador++;
    }
    public function atacar($objetivo){
        $objetivo->puntosVida - $this->puntosAtaque;

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
    
    public function partida($jugadores){
        #$jugadores = readline();
        $rondas = readline("Cuantas rondas quieres jugar: ");
        for($i = 0 ; $i <= $rondas * $jugadores ; $i++){
            foreach(range(1 , $jugadores) as $num){
                echo "Es el turno de $jugador1->nombre";
                
            }
        }
    }
}   

echo "Bienvenido a al juego";
$jugadores = readline("Establezca numero de jugadores (5 maximo): ");
$cont = 0;
while($cont <= $jugadores){
    $jugador1 = 0;
    $nombre1 = readline("Inserte nombre del jugador $cont: ");
    $jugador1 = new Personaje($nombre1, 1, 100, 50);
    $cont++;

    $jugador2 = 0;
    $nombre2 = readline("Inserte nombre del jugador $cont: ");
    $jugador2 = new Personaje($nombre2, 1, 100, 50);
    $cont++;

    $jugador3 = 0;
    $nombre3 = readline("Inserte nombre del jugador $cont: ");
    $jugador3 = new Personaje($nombre3, 1, 100, 50);
    $cont++;

    $jugador4 = 0;
    $nombre4 = readline("Inserte nombre del jugador $cont: ");
    $jugador4 = new Personaje($nombre4, 1, 100, 50);
    $cont++;

    $jugador5 = 0;
    $nombre5 = readline("Inserte nombre del jugador $cont: ");
    $jugador5 = new Personaje($nombre5, 1, 100, 50);
    $cont++;

}