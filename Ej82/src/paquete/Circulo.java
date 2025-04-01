package paquete;

public class Circulo extends Figura implements Calculable{

	private double radio;
	
	public Circulo(String color, double radio) {
		super(color);
		this.radio = radio;
		
	}
	public double calcularArea() {
		return Math.PI * radio * radio;
	}
	
}
