package paquete;

abstract class Animal implements Comunicable {

	protected String nombre;
	
	public Animal(String nombre) {
		this.nombre = nombre;
	}
}
