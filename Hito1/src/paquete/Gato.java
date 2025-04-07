package paquete;

public class Gato extends Animal{
	
	private boolean leucemia;
	//creamos el contructor heredando los datos de animal y agregandole leucemia
	public Gato (int numChip , String nombre , String raza , int edad , boolean adoptado, boolean leucemia) {
		super(numChip , nombre , raza , edad , adoptado);
		this.leucemia = leucemia;
	}
	
	//sobreescribimos el metodo mostrar y hacemos que muestre todos los datos del animal
	@Override
	public void mostrar() {
		System.out.println("Chip: " + this.numChip + "\nNombre: " + this.nombre + "\nRaza: " + this.raza + "\nAdoptado: " + this.adoptado + "\nLeucemia: " + this.leucemia);
		
	}
	

}
