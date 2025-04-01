package paquete;
import java.util.ArrayList;

public class Principal {

	public static void main (String[] args) {
	
		ArrayList<Animal> lista = new ArrayList<>();
		
		lista.add(new Perro("Luna"));
		lista.add(new Gato("Luigi"));
		lista.add(new Perro("Frodo"));
		
		for (Animal item : lista) {
			System.out.println(item.hacerSonido());
		}
	}
}