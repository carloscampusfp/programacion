package paquete;

public class Perro extends Animal implements Comunicable{

	public Perro(String nombre) {
		super(nombre);
	}
	public String hacerSonido() {
		return "Guau Guau";
	}
}
