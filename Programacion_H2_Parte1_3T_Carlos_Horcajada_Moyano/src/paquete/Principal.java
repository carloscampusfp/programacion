package paquete;

// Importamos librerías necesarias para JDBC, listas y entrada por consola
import java.sql.*;
import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

public class Principal {

    public static void main(String[] args) {
        
        try {
            // Cargamos el driver JDBC de MySQL para habilitar la conexión
            Class.forName("com.mysql.cj.jdbc.Driver");
        } catch (ClassNotFoundException e) {
            // Si no se encuentra el driver, mostramos error y salimos del programa
            System.err.println("ERROR: No se encontró el driver JDBC de MySQL. Asegúrate de tener el .jar en el classpath.");
            e.printStackTrace();
            return;
        }

        // Creamos objeto Scanner para leer datos del usuario por consola
        Scanner sc = new Scanner(System.in);
        int opcion;
        do {
            // Mostramos el menú principal
            System.out.println("\n--- MENÚ ---");
            System.out.println("1 - Ver películas");
            System.out.println("2 - Salir");
            System.out.print("Selecciona una opción: ");
            opcion = sc.nextInt(); // Leemos la opción ingresada

            // Según la opción seleccionada, ejecutamos una acción
            switch (opcion) {
                case 1:
                    verPeliculas(); // Llamamos al método que muestra las películas
                    break;
                case 2:
                    System.out.println("Saliendo del programa..."); 
                    break;
                default:
                    System.out.println("Opción no válida."); 
            }
        } while (opcion != 2); // Repetimos hasta que se seleccione salir

        sc.close(); // Cerramos el Scanner al finalizar
    }

    public static void verPeliculas() {
        // URL de conexión a la base de datos, nombre de usuario y contraseña
        String url = "jdbc:mysql://localhost:3306/cine_Carlos_Horcajada_Moyano";
        String usuario = "root";
        String contraseña = "";

        // Consulta SQL que une las tablas 'peliculas' y 'generos'
        String sql = ""
            + "SELECT p.id_pelicula, p.titulo, p.director, p.duracion, p.año, g.nombre_genero "
            + "FROM peliculas p "
            + "JOIN generos g ON p.id_genero = g.id_genero";

        // Establecemos conexión, preparamos y ejecutamos la consulta
        try (Connection conn = DriverManager.getConnection(url, usuario, contraseña);
             PreparedStatement stmt = conn.prepareStatement(sql);
             ResultSet rs = stmt.executeQuery()) {

            // Encabezados para mostrar los resultados en formato tabla
            System.out.println("ID | Título               | Director            | Duración | Año  | Género");
            System.out.println("----------------------------------------------------------------------------");

            // Recorremos cada fila del resultado
            while (rs.next()) {
                int    id       = rs.getInt("id_pelicula"); 
                String titulo   = rs.getString("titulo");     
                String director = rs.getString("director");      
                int    duracion = rs.getInt("duracion");          
                int    año      = rs.getInt("año");                
                String genero   = rs.getString("nombre_genero");   

                // Mostramos los datos en consola de forma formateada
                System.out.println(
                    id + " | " +
                    titulo + " | " +
                    director + " | " +
                    duracion + " min | " +
                    año + " | " +
                    genero
                );
            }

        } catch (SQLException e) {
            // Mostramos error si hay problemas de conexión o SQL
            System.err.println("Error al consultar películas: " + e.getMessage());
            e.printStackTrace();
        }
    }
}
