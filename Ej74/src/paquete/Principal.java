package paquete;
import java.util.HashMap;
import java.util.Scanner;

public class Principal {

	public static void main (String[] args) {
		HashMap<String , Integer> edades = new HashMap<>();
		edades.put("Carlos" , 19);
		edades.put("Eugenia" , 20);
		
		Scanner scanner = new Scanner(System.in);
		
		System.out.println("Escribe el nombre: ");
		String palabra = scanner.next(); 
		palabra = palabra.substring(0,1).toUpperCase() + palabra.substring(1).toLowerCase();;
		
		
		System.out.println(edades.get(palabra));
	}

}
