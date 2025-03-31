package paquete;

public class Principal {
	
	public static void main (String[] args) {
		int[][] matriz = new int[3][3];
		int numero = 1;
		
		for (int fila = 0 ; fila < 3 ; fila++) {
			System.out.print("[");
			for (int columna = 0 ; columna < 3 ; columna++) {
				matriz[fila][columna] = numero;
				numero++;
				System.out.print(matriz[fila][columna]);
			}
			System.out.print("]\n");
		}

	}

}
