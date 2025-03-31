package paquete;
import java.util.ArrayList;

public class Principal {

	public static void main (String[] args) {
		ArrayList<String> tareas = new ArrayList<>();
		tareas.add("comprar");
		tareas.add("sacar la basura");
		tareas.add("correr");
		
		tareas.remove(1);
		for (int i = 0 ; i < tareas.size() ; i++) {
			String tarea = tareas.get(i);
			System.out.println(tarea);
			
		}
	}
}
