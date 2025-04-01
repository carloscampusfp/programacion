package paquete;

public class Coche extends Vehiculo implements Movile{

	public void mover() {
		System.out.print("Run run me muevo jaja");
	}
	public Coche(String id) {
		super(id);
	}
	
	
}
