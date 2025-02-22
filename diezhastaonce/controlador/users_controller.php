<?php
require_once __DIR__ . "/../modelo/class_user.php";

class UsuariosController{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new User();
    }

    public function autenticarUsuario($usuario, $password)
    {
        return $this->modelo->autenticarUsuario($usuario, $password);
    }

    public function obtenerRol($usuario)
    {
        return $this->modelo->obtenerRol($usuario);
    }

    public function registrarUsuario($usuario, $password, $rol)
    {
        $this->modelo->registrarUsuario($usuario, $password, $rol);
    }

    public function redirigirUsuario($rol)
    {
        $this->modelo->redirigirUsuario($rol);
    }

    public function obtenerUsuarios()
    {
        return $this->modelo->obtenerUsuarios();
    }

    public function editarUsuario($id, $usuario, $rol, $password = null)
    {
        $this->modelo->editarUsuario($id, $usuario, $rol, $password);
    }

    public function eliminarUsuario($id)
    {
        $this->modelo->eliminarUsuario($id);
    }

    public function obtenerUsuarioPorId($id)
    {
        return $this->modelo->obtenerUsuarioPorId($id);
    }
}