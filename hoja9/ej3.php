<?php

class Usuario{
    protected $nombre;
    protected $email;

    public function __construct($nombre, $email){
        $this->nombre = $nombre;
        $this->email = $email;
    }
    public function mostrarInfo(){
        echo "Nombre: $this->nombre | Email: $this->email\n";
    }
}

class Administrador extends Usuario{
    protected $nivelAcceso;

    public function __construct($nombre, $email, $nivelAcceso){
        parent::__construct($nombre, $email);
        $this->nivelAcceso = $nivelAcceso;
    }
    public function mostrarInfo(){
        echo "Nombre: $this->nombre | Email: $this->email | Nivel de acceso: $this->nivelAcceso\n";
    }
}

$usuario = new Usuario('Carlos', 'lalala@gmail.com');
$administrador = new Administrador('Pepe', 'pepe@gmail.com', 1);

$usuario->mostrarInfo();
$administrador->mostrarInfo();
