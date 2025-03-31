package paquete;
import java.util.ArrayList;
public class Principal {

	public static void main(String[] args) {
   
        ArrayList<String> nombres = new ArrayList<>();
        nombres.add("Ana");
        nombres.add("Carlos");
        nombres.add("María");
        nombres.add("Luis");
        nombres.add("Sofía");

        
        System.out.println("Nombres en mayúsculas:");
        for (String nombre : nombres) {
            System.out.println(nombre.toUpperCase());
        }
    }
}
