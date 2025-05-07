package paquete;

import java.sql.*;
import java.util.Scanner;

public class Principal {

    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        int opcion;
        
        //mostramos el menu al menos vez
        do {
            System.out.println("\n--- MENU ---");
            System.out.println("1 - Ver peliculas");
            System.out.println("2 - Agregar pelicula");
            System.out.println("3 - Actualizar pelicula");
            System.out.println("4 - Eliminar pelicula");
            System.out.println("5 - Salir");
            System.out.print("Selecciona una opcion: ");
            opcion = sc.nextInt();
            sc.nextLine(); // Limpia buffer

            //en funcion de lo que escriba el usuario esjecutará unas u otras acciones
            switch (opcion) {
                case 1 -> verPeliculas();
                case 2 -> agregarPelicula(sc);
                case 3 -> actualizarPelicula(sc);
                case 4 -> eliminarPelicula(sc);
                case 5 -> System.out.println("Saliendo del programa...");
                default -> System.out.println("Opcion no valida.");
            }
        } while (opcion != 5);

        sc.close();
    }

    
    public static void verPeliculas() {
        String sql = """
            SELECT p.id_pelicula, p.titulo, p.director, p.duracion, p.anio, g.nombre_genero
            FROM peliculas p
            JOIN generos g ON p.id_genero = g.id_genero
            """;

        try (Connection conn = conexion.conectar();
             PreparedStatement stmt = conn.prepareStatement(sql);
             ResultSet rs = stmt.executeQuery()) {

            System.out.println("ID | Titulo              | Director           | Duracion | Año | Genero");
            System.out.println("------------------------------------------------------------------------");

            while (rs.next()) {
                int id = rs.getInt("id_pelicula");
                String titulo = rs.getString("titulo");
                String director = rs.getString("director");
                int duracion = rs.getInt("duracion");
                int anio = rs.getInt("anio");
                String genero = rs.getString("nombre_genero");

                // Crear un objeto Pelicula y usar el método mostrar
                Pelicula pelicula = new Pelicula(id, titulo, director, duracion, anio, genero);
                pelicula.mostrar();
            }

        } catch (SQLException e) {
            System.err.println("Error al consultar peliculas: " + e.getMessage());
        }
    }

    public static void agregarPelicula(Scanner sc) {
        System.out.print("Titulo: ");
        String titulo = sc.nextLine();
        System.out.print("Director: ");
        String director = sc.nextLine();
        System.out.print("Duracion (min): ");
        int duracion = sc.nextInt();
        System.out.print("Año: ");
        int anio = sc.nextInt();
        System.out.print("ID del genero: ");
        int idGenero = sc.nextInt();

        String sql = "INSERT INTO peliculas (titulo, director, duracion, anio, id_genero) VALUES (?, ?, ?, ?, ?)";
        
        //dentro del try nos intentaremos conectar, si no lo consigue pasará al catch
        try (Connection conn = conexion.conectar();
             PreparedStatement stmt = conn.prepareStatement(sql)) {
        	
        	// Desactivamos autoCommit para gestionar la transacción manualmente
        	 conn.setAutoCommit(false);
        	
        	//configuramos los parametros de la consulta que vamos a hacer
            stmt.setString(1, titulo);
            stmt.setString(2, director);
            stmt.setInt(3, duracion);
            stmt.setInt(4, anio);
            stmt.setInt(5, idGenero);
            stmt.executeUpdate();
            System.out.println("Pelicula agregada correctamente.");
            
            conn.commit();

        } catch (SQLException e) {
            System.err.println("Error al agregar pelicula: " + e.getMessage());
            
        }
    }

    public static void actualizarPelicula(Scanner sc) {
        System.out.print("ID de la pelicula a actualizar: ");
        int id = sc.nextInt();
        sc.nextLine();
        System.out.print("Nuevo titulo: ");
        String titulo = sc.nextLine();
        System.out.print("Nuevo director: ");
        String director = sc.nextLine();
        System.out.print("Nueva duracion (min): ");
        int duracion = sc.nextInt();
        System.out.print("Nuevo año: ");
        int anio = sc.nextInt();
        System.out.print("Nuevo ID del genero: ");
        int idGenero = sc.nextInt();

        String sql = """
            UPDATE peliculas SET titulo=?, director=?, duracion=?, anio=?, id_genero=?
            WHERE id_pelicula=?
            """;

        try (Connection conn = conexion.conectar()) {
            // Desactivamos autoCommit para manejar la transacción manualmente
            conn.setAutoCommit(false);

            try (PreparedStatement stmt = conn.prepareStatement(sql)) {
                // Configuramos los parámetros para la consulta
                stmt.setString(1, titulo);
                stmt.setString(2, director);
                stmt.setInt(3, duracion);
                stmt.setInt(4, anio);
                stmt.setInt(5, idGenero);
                stmt.setInt(6, id);

                // Ejecutamos la actualización
                int filas = stmt.executeUpdate();

                if (filas > 0) {
                    // Confirmamos la transacción si la actualización afectó filas
                    conn.commit();
                    System.out.println("Pelicula actualizada correctamente.");
                } else {
                    // Si no se actualizó nada, revertimos la transacción
                    conn.rollback();
                    System.out.println("No se encontró una pelicula con ese ID.");
                }
            } catch (SQLException e) {
                // Si ocurre una excepción, revertimos los cambios
                conn.rollback();
                System.err.println("Error al actualizar pelicula: " + e.getMessage());
            }
        } catch (SQLException e) {
            System.err.println("Error de conexión a la base de datos: " + e.getMessage());
        } finally {
            try {
                // Aseguramos que autoCommit se restaure a true después de cada transacción
                Connection conn = conexion.conectar();
                if (conn != null) {
                    conn.setAutoCommit(true);
                }
            } catch (SQLException e) {
                System.err.println("Error al restaurar autoCommit: " + e.getMessage());
            }
        }
    }


    public static void eliminarPelicula(Scanner sc) {
        System.out.print("ID de la pelicula a eliminar: ");
        int id = sc.nextInt();

        String sql = "DELETE FROM peliculas WHERE id_pelicula=?";

        try (Connection conn = conexion.conectar();
             PreparedStatement stmt = conn.prepareStatement(sql)) {

        	 conn.setAutoCommit(false);
        	
            stmt.setInt(1, id);
            int filas = stmt.executeUpdate();
            if (filas > 0)
                System.out.println("Pelicula eliminada correctamente.");
            else {
            	//controlamos que si no existe diga que no la encu
                System.out.println("No se encontró una pelicula con ese ID.");
            }

        } catch (SQLException e) {
            System.err.println("Error al eliminar pelicula: " + e.getMessage());
        }
    }
}
