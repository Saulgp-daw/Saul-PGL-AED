package es.iespuertodelacruz.saul.recycleviewejemplos;

public class Pelicula {
    String titulo;
    int duracion;
    String caratula;

    public Pelicula() {
    }

    public String getTitulo() {
        return titulo;
    }

    public void setTitulo(String titulo) {
        this.titulo = titulo;
    }

    public int getDuracion() {
        return duracion;
    }

    public void setDuracion(int duracion) {
        this.duracion = duracion;
    }

    public String getCaratula() {
        return caratula;
    }

    public void setCaratula(String caratula) {
        this.caratula = caratula;
    }

    public Pelicula(String titulo, int duracion, String caratula) {
        this.titulo = titulo;
        this.duracion = duracion;
        this.caratula = caratula;
    }
}
