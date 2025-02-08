<?php
require_once "../conexion/conexion_bd.php";


class User{ /* creamos la clase usuario */
    private $conexion;

    public function __construct(){ /*  */
        $this->conexion = new Conexion();
    }

    public function singUp($nombre, $correo, $password){ /* esta funcion sirve para registrar un nuevo usuario */

        $query =  "INSERT INTO users (name_user, email_user, password_user) VALUES (?, ?, ?)";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt-> bind_param("sss", $nombre, $correo, password_hash($password, PASSWORD_DEFAULT)); /* con el password_hash encriptaremos la contraseña, con el password default le estamos indicando el tipo de encriptacion que queremos que haga */

        if ($stmt->execute()){
            echo "<div class='alert alert-success'>Usuario registrado con éxito.</div>";
            header("Location: ../views/lista_tareas.php");
        }else {
            echo "<div class='alert alert-danger'>" . "Error al registrar usuario: " . $stmt->error . "</div>";
        }
        $stmt->close();
    }

    public function logIn($correo, $password){
       
        $query = "SELECT * FROM users WHERE email_user = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $fila = $resultado->fetch_assoc();
        if ($fila) { /* con esta funcion verificamos que la contraseña y el correo coincidan correctamente se encargará además de identificar la forma en la que la hemos encriptado, por lo que no nos dará problemas eso */
            return password_verify($password, $fila["password_user"]); 
        }else{
            return false;
        }
    }

    public function logOut(){ /* cerramos la sesion correctamente y la destruimos */
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../sesion/login.php");

    }


    public function obtenerTareas($correo){ /* obtenemos las tareas teniendo en cuenta el correo de la sesion actual, para que solo salgan sus tareas */
        $query = "SELECT * FROM tasks WHERE user_task = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt-> bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $tareas = [];
        while ($fila = $resultado->fetch_assoc()) {
            $tareas[] = $fila;
        }
        $stmt->close();
        return $tareas;
       
    }

    public function agregarTareas($nombre_tarea, $descripcion, $email_usuario){ /* agregamos las tareas asociandolas al usuario que las está creando */
        $query =  "INSERT INTO tasks (name_task, description_task, user_task) VALUES (?, ?, ?)";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt-> bind_param("sss", $nombre_tarea, $descripcion, $email_usuario);

        if ($stmt->execute()){
            echo "<div class='alert alert-success'>Tarea registrada con éxito.</div>";
        }else {
            echo "<div class='alert alert-danger'>" . "Error al registrar tarea: " . $stmt->error . "</div>";
        }
        $stmt->close();
    }

    public function eliminarTareas($id_tarea){ /* aqui permitimos al usuario borrar las tareas, como vamos a mandar el id de la tarea por get al pulsar un boton entre sus tareas, solo podrá borrar sus tareas */
        $query =  "DELETE FROM tasks WHERE id_task = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt-> bind_param("i", $id_tarea);

        if ($stmt->execute()){
            echo "<div class='alert alert-success'>Tarea eliminada con éxito.</div>";
        }else {
            echo "<div class='alert alert-danger'>" . "Error al eliminar tarea: " . $stmt->error . "</div>";
        }
        $stmt->close();
    }
    
    public function actualizarEstado($id_tarea, $estado){ /* actualizamos el estado de la tarea */
        $query = "UPDATE tasks SET state_task = ? WHERE id_task = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt-> bind_param("si", $estado, $id_tarea);
        if ($stmt->execute()){
            echo "<div class='alert alert-success'>Tarea actualizada con éxito.</div>";
        }else {
            echo "<div class='alert alert-danger'>" . "Error al actualizar tarea: " . $stmt->error . "</div>";
        }
        $stmt->close();
    }

}