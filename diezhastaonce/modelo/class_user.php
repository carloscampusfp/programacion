<?php
require_once "../config/db_config.php";

class User{
    private $conexion;

    public function __construct(){
        $this->conexion = new Conexion();
    }

    public function registrarUsuario($usuario, $password, $rol){
        $query = "INSERT INTO usuarios (usuario, password, rol) VALUES (?, ?, ?)";
        $stmt = $this->conexion->conexion->prepare($query);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("sss", $usuario, $hashed_password, $rol);
        $stmt->execute();
        $stmt->close();
    }
       
    public function obtenerRol($usuario){
        $query = "SELECT rol FROM usuarios WHERE usuario = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $fila = $resultado->fetch_assoc();
        return $fila["rol"];
    }

    public function autenticarUsuario($usuario, $password){
        $query = "SELECT * FROM usuarios WHERE usuario = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $fila = $resultado->fetch_assoc();
        if ($fila) {
            return password_verify($password, $fila["password"]);
        }
        return false;
    }

    public function redirigirUsuario($role){
        if ($role === "admin") {
            header("Location: /vista/usuarios/lista_usuarios.php");
        } else {
            header("Location: /index.php");
        }
        exit;
    }

    public function obtenerUsuarios(){
        $query = "SELECT * FROM usuarios";
        $resultado = $this->conexion->conexion->query($query);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function editarUsuario($id, $usuario, $rol, $password = null){
        if ($password) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE usuarios SET usuario = ?, rol = ?, password = ? WHERE id_usuario = ?";
            $stmt = $this->conexion->conexion->prepare($query);
            $stmt->bind_param("sssi", $usuario, $rol, $hashed_password, $id);
        } else {
            $query = "UPDATE usuarios SET usuario = ?, rol = ? WHERE id_usuario = ?";
            $stmt = $this->conexion->conexion->prepare($query);
            $stmt->bind_param("ssi", $usuario, $rol, $id);
        }
        $stmt->execute();
        $stmt->close();
    }

    public function eliminarUsuario($id){
        $query = "DELETE FROM usuarios WHERE id_usuario = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        if ($stmt->affected_rows === 0) {
            throw new mysqli_sql_exception("No se ha encontrado un usuario con ese ID.");
        }
        $stmt->close();
    }

    public function obtenerUsuarioPorId($id)
    {
        $query = "SELECT * FROM usuarios WHERE id_usuario = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }
}