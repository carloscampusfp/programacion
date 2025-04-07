package paquete;

//importamos las librerias necesarias
import java.util.Scanner;
import java.util.ArrayList;

public class Principal {
	//aqui creo un array estático en el que se almacenaran los objetos animal
	static ArrayList<Animal> animales = new ArrayList<>();

	//creo el main para poder ejecutar el codigo
	public static void main(String[] args) {
		//creo el scanner solo 1 vez, ya que me estaba generando errores con varios aunque los cerrase
		Scanner scanner = new Scanner(System.in);
		int menu = 0;
		//creo un menu para que el usuario indique que ha de hacer el programa
		while (menu != 3) {
			System.out.println("¿Qué acción deseas realizar? (1 = dar de alta, 2 = mostrar animal, 3 = salir)");
			menu = scanner.nextInt();
			scanner.nextLine(); 

			switch (menu) {
				case 1: //aqui se ejecuta la funcion alta, pasandole el array y el scanner, ya que tendrá que utilizarlos
					alta(animales, scanner);
					break;
				case 2: //aqui se ejecuta la funcion mostrar, pasandole el array y el scanner, ya que tendrá que utilizarlos
					mostrar(animales, scanner);
					break;
				case 3: //salimos del programa pulsando 3
					System.out.println("Saliendo del programa...");
					break;
				default: //aqui le digo que no es valida esa opcion y cierra el programa, es verdad que hace lo mismo que si marcase 3, pero pienso que queda mejor asi
					System.out.println("Opción no válida");
					break;
			}
		}

		scanner.close(); //cierro el scanner para evitar errores
	}

	public static void alta(ArrayList<Animal> animales, Scanner scanner) { //creo un metodo estatico para no tener que instanciarlo al usarlo
		System.out.println("¿El animal es un perro o un gato? (1 = perro, 2 = gato) ");
		int queEs = scanner.nextInt();
		scanner.nextLine(); //esto lo tenoo ya que al poner un scanner de algo, guarda el salto de linea y luego cuando se vaya a usar un nextline crea fallos, ya que el nextline espera a que ocurra un salto de linea

		System.out.println("Escribe el número de chip del animal: ");
		int chip = scanner.nextInt();
		scanner.nextLine();

		for (Animal animal : animales) { //comprobamos que el chip no este en uso
			if (animal.numChip == chip) {
				System.out.println("Ese chip ya está en uso");
				return;
			}
		}

		System.out.println("Escribe el nombre del animal: ");
		String nombre = scanner.nextLine();

		System.out.println("Escribe la edad del animal: ");
		int edad = scanner.nextInt();
		scanner.nextLine();

		System.out.println("Escribe la raza del animal: ");
		String raza = scanner.nextLine();

		System.out.println("¿El animal es adoptado? (true/false): ");
		boolean adoptado = scanner.nextBoolean();
		scanner.nextLine();
		//aqui en funcion de que animal sea le preguntara unos datos u otros y lo añadira al arraylist
		if (queEs == 1) { 
			System.out.println("Escribe el tamaño del animal: ");
			String tamanio = scanner.nextLine();
			animales.add(new Perro(chip, nombre, raza, edad, adoptado, tamanio));
		} else if (queEs == 2) { 
			System.out.println("¿Tiene leucemia? (true/false): ");
			boolean leucemia = scanner.nextBoolean();
			scanner.nextLine();
			animales.add(new Gato(chip, nombre, raza, edad, adoptado, leucemia));
		} else {
			System.out.println("Opción inválida.");
		}
	}

	public static void mostrar(ArrayList<Animal> animales, Scanner scanner) {
		System.out.println("Escribe el número de chip del animal: ");
		int chip = scanner.nextInt();
		scanner.nextLine();
		//aqui buscara por chip para ejecutar la funcion mostrar
		for (Animal animal : animales) {
			if (animal.numChip == chip) {
				animal.mostrar();
			 return;
			}
		}

		System.out.println("Animal no encontrado");
	}
}
