package paquete;
import java.util.ArrayList;

public class Principal {

	public static void main (String[] args) {
		
		ArrayList<Vehiculo> lista = new ArrayList<>();
		lista.add(new Coche("1"));
		lista.add(new Bicicleta("2"));
		lista.add(new Coche("3"));
		
		for ( int i = 0 ; i < lista.size() ; i++) {
			lista.get(i).mover();
		}
	}
}
