package paquete;

public class Rectangulo extends Figura implements Calculable{

	private double altura;
	private double base;
	
	public Rectangulo(String color, double altura, double base) {
		super(color);
		this.altura = altura;
		this.base = base;
		
	}
	public double calcularArea() {
		return base * altura;
	}
	
}
