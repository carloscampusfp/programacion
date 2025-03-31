package paquete;

public class Principal {

	public static void main (String[] args) {
		Producto tomate = new Producto("tomate" , 30.00);
		Producto pera = new Producto("pera" , 37.00);
		Producto patata = new Producto("patata" , 14.00);
		
		Producto[] productos= {tomate, pera, patata};
		
		for (int i = 0 ; i < productos.length ; i++) {
			System.out.println(productos[i].nombre);
			System.out.println(productos[i].precio + "\n");

		}
		
	}
}
