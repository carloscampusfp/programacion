<?php
require_once "./conexion.php";


class Usuario{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    public function agregarUsuario($nombre, $apellidos, $correo, $edad, $plan, $paquete, $duracion, $precio) {
        try{  
           
            $query = "INSERT INTO usuarios (nombre, apellidos, correo, edad, plan, paquete, duracion, precio )values(?,?,?,?,?,?,?,?)"; #estamos usando este query de tal forma en la que se rellene con variables, por eso escribimos el ?
            $stmt = $this->conexion->conexion->prepare($query);  #el prepare se suele usar para cuando le queremos dar un valor dinámico a los campos del query
            $stmt->bind_param("sssisssd", $nombre, $apellidos, $correo, $edad, $plan, $paquete, $duracion, $precio); #aqui es donde vinculamos las ? con las variables que nosotros queramos

            if ($stmt->execute()) { #he colocado el execute aquí ya que el if para comprobar si es true o false el execute debera de activar la funcion, por lo que me ahorro una linea y muestro un mensaje de error en caso de que falle.
                echo "<div class='alert alert-success'>Usuario agregado con éxito.</div>";
            } else {
                echo "<div class='alert alert-danger'>" . "Error al agregar usuario: " . $stmt->error . "</div>";
            }

            $stmt->close();
        }catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) {
                echo "<div class='alert alert-danger'>El correo electrónico ya está registrado.</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
            }
            #Si ocurre algún error, se captura aquí y mostramos el mensaje
            
        }
    }

    public function obtenerUsuarios() {
        try{
            $query = "SELECT * FROM usuarios";
            $resultado = $this->conexion->conexion->query($query); #usamos el metodo query ya que no necesitamos un valor dinámico para realizar la consulta
            $usuarios = [];
            while ($fila = $resultado->fetch_assoc()) {
                $usuarios[] = $fila;
            }
            return $usuarios;
        }catch (Exception $e) {
            #Si ocurre algún error, se captura aquí y mostramos el mensaje
            echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
            }
        
    }

    public function detallarPrecio($id) {
        try{
            $query = "SELECT *  FROM usuarios WHERE id = ?";
            $stmt = $this->conexion->conexion->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $resultado = $stmt->get_result();
            return $resultado->fetch_assoc();
        }catch (Exception $e) {
            #Si ocurre algún error, se captura aquí y mostramos el mensaje
            echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
            }
        
    }

    public function actualizarUsuario($nombre, $apellidos, $correo, $edad, $plan, $paquete, $duracion, $precio, $id) {
        try{
            $query = "UPDATE usuarios SET nombre = ?, apellidos = ?, correo = ?, edad = ?, plan = ?, paquete = ?, duracion = ?, precio = ? WHERE id = ?"; #no se si deberia de añadir que actualice el precio, mas bien no se como hacerlo para que se haga automáticamente
            $stmt = $this->conexion->conexion->prepare($query);
            $stmt->bind_param("sssisssdi", $nombre, $apellidos, $correo, $edad, $plan, $paquete, $duracion, $precio, $id);
            

            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Usuario actualizado con éxito.</div>";
            } else {
                echo "<div class='alert alert-danger'>" . "Error al actualizar el usuario: " . $stmt->error . "</div>";
            }

        $stmt->close();
        }catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) {
                echo "<div class='alert alert-danger'>El correo electrónico ya está registrado.</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
            }
            #Si ocurre algún error, se captura aquí y mostramos el mensaje
            
            }
        
    }

    public function eliminarUsuario($id){
        try{
            $query = "DELETE FROM usuarios WHERE id = ?";
            $stmt = $this->conexion->conexion->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                echo "<div class='alert alert-success'>Usuario eliminado con éxito.</div>";
            } else {
                echo "<div class='alert alert-danger'>" . "Error: el usuario no existe " . "</div>";
            }

            $stmt->close();
        }catch (Exception $e) {
            #Si ocurre algún error, se captura aquí y mostramos el mensaje
            echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
            }
    }

}

