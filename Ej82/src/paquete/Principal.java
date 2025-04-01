package paquete;
import java.util.ArrayList;

public class Principal {

	public static void main (String[] args) {
		
		ArrayList<Figura> figuras = new ArrayList<>();
		
		figuras.add(new Circulo("rojo", 15.0));
		figuras.add(new Rectangulo("azul", 15.0, 20.0));
		figuras.add(new Circulo("verde", 15.0));
		
		for(Figura figura : figuras) {
			System.out.println(figura.calcularArea() + " " + figura.color);
			
		}
		
	}
}
