package paquete;

public class Pelicula {
    private int id;
    private String titulo;
    private String director;
    private int duracion;
    private int año;
    private String genero;
    
//Creamos el construct
    public Pelicula(int id, String titulo, String director, int duracion, int año, String genero) {
        this.id = id;
        this.titulo = titulo;
        this.director = director;
        this.duracion = duracion;
        this.año = año;
        this.genero = genero;
    }

    //Creamos el metodo para que se muestrn los datos de la peli
    public void mostrar() {
        System.out.println(id + " | " + titulo + " | " + director + " | " + 
                           duracion + " min | " + año + " | " + genero);
    }
}
