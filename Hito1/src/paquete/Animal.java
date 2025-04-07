package paquete;
//clase abstracta
abstract class Animal {
	//variables de la clase
	protected int numChip;
	protected String nombre;
	protected String raza;
	protected int edad;
	protected boolean adoptado;
	
	//metodo abstracto mostrar
	abstract void mostrar();
	
	//constructor
	
	public Animal(int numChip , String nombre , String raza , int edad,  boolean adoptado) {
		this.numChip = numChip;
		this.nombre = nombre;
		this.raza = raza;
		this.edad = edad;
		this.adoptado = adoptado;
	}
}
