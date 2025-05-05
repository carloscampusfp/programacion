package paquete;

import java.sql.*;

public class conexion {
    public static Connection conectar() {
        try {
            return DriverManager.getConnection("jdbc:mysql://localhost:3306/cine_Carlos_Horcajada_Moyano", "root", "");
        } catch (SQLException e) {
            System.out.println("Error de conexión: " + e.getMessage());
            return null;
        }
    }
}