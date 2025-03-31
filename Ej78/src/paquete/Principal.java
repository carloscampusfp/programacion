package paquete;
import java.util.ArrayList;
import java.util.Iterator;

public class Principal {

	public static void main (String[] args) {
		
		ArrayList<String> frutas = new ArrayList<>();
		frutas.add("pera");
		frutas.add("sandia");
		frutas.add("platano");
		
		Iterator<String> it = frutas.iterator();
		while (it.hasNext()) {
		    String f = it.next();
		    if (f.equals("pera")) {
		        it.remove(); 
		    }
		}

	}

	
}
