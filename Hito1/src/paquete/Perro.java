package paquete;

public class Perro extends Animal{
	
	private String tamanio;
	//creamos el contructor heredando los datos de animal y agregandole tamanio
	public Perro (int numChip , String nombre , String raza , int edad, boolean adoptado, String tamanio) {
		super(numChip , nombre , raza , edad , adoptado);
		this.tamanio = tamanio;
	}
	
	//sobreescribimos el metodo mostrar y hacemos que muestre todos los datos del animal
	@Override
	public void mostrar() {
		System.out.println("Chip: " + this.numChip + "\nNombre: " + this.nombre + "\nRaza: " + this.raza + "\nAdoptado: " + this.adoptado + "\nTamaño: " + this.tamanio);
		
	}
	

}
