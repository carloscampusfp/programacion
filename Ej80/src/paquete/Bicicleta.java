package paquete;

public class Bicicleta extends Vehiculo implements Movile{

	public void mover() {
		System.out.print("Ring ring me muevo jeje");
	}
	public Bicicleta(String id) {
		super(id);
	}
	
	
}
