package paquete;
import java.util.HashSet;

public class Principal {

	public static void main (String[] argas) {
		HashSet<String> colores = new HashSet<>();
		colores.add("rojo");
		colores.add("azul");
		
		System.out.print(colores.size());
	}
}
