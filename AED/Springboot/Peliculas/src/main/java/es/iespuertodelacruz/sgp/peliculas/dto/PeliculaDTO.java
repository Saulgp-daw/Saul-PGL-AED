package es.iespuertodelacruz.sgp.peliculas.dto;

import java.util.List;

import es.iespuertodelacruz.sgp.peliculas.entities.Categoria;

public class PeliculaDTO {
	private String titulo;
	private String actores;
	private String argumento;
	private String direccion;
	private String trailer;
	private String fotoBase64;
	private String nombreFichero;
	private List<Categoria> lista;
	
	public String getNombreFichero() {
		return nombreFichero;
	}

	public void setNombreFichero(String nombreFichero) {
		this.nombreFichero = nombreFichero;
	}

	public PeliculaDTO(String titulo, String actores, String argumento, String direccion, String trailer,
			String fotoBase64, String nombreFichero, List<Categoria> lista) {
		this.titulo = titulo;
		this.actores = actores;
		this.argumento = argumento;
		this.direccion = direccion;
		this.trailer = trailer;
		this.fotoBase64 = fotoBase64;
		this.nombreFichero = nombreFichero;
		this.lista = lista;
	}

	public List<Categoria> getLista() {
		return lista;
	}

	public void setLista(List<Categoria> lista) {
		this.lista = lista;
	}

	public PeliculaDTO() {
	}

	public String getTitulo() {
		return titulo;
	}

	public void setTitulo(String titulo) {
		this.titulo = titulo;
	}

	public String getActores() {
		return actores;
	}

	public void setActores(String actores) {
		this.actores = actores;
	}

	public String getArgumento() {
		return argumento;
	}

	public void setArgumento(String argumento) {
		this.argumento = argumento;
	}

	public String getDireccion() {
		return direccion;
	}

	public void setDireccion(String direccion) {
		this.direccion = direccion;
	}

	public String getTrailer() {
		return trailer;
	}

	public void setTrailer(String trailer) {
		this.trailer = trailer;
	}

	public String getFotoBase64() {
		return fotoBase64;
	}

	public void setFotoBase64(String fotoBase64) {
		this.fotoBase64 = fotoBase64;
	}
	
	
	
	
	
	
}
