package paquete;

import java.util.Scanner;


public class Principal {

	public static void main (String[] args) {

		Scanner scanner = new Scanner(System.in);
		int[] numeros = new int[5];
		
		for (int i = 0 ; i < numeros.length ; i++) {
			System.out.println("Escribe un número: ");
			int numero = scanner.nextInt(); 
			numeros[i] = numero;
		}
		
		for (int c = 0 ; c < numeros.length ; c++) {
			System.out.println(numeros[c]);
		}
	}
}
