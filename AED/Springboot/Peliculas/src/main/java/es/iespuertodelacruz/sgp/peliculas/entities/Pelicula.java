package es.iespuertodelacruz.sgp.peliculas.entities;

import java.io.Serializable;
import jakarta.persistence.*;
import java.util.List;

import com.fasterxml.jackson.annotation.JsonIgnore;


/**
 * The persistent class for the Peliculas database table.
 * 
 */
@Entity
@Table(name="Peliculas")
@NamedQuery(name="Pelicula.findAll", query="SELECT p FROM Pelicula p")
public class Pelicula implements Serializable {
	private static final long serialVersionUID = 1L;

	@Id
	private int id;

	private String actores;

	private String argumento;

	private String direccion;

	private String imagen;

	private String titulo;

	private String trailer;

	//bi-directional many-to-many association to Categoria
	@JsonIgnore
	@ManyToMany(fetch= FetchType.LAZY)
	@JoinTable(
		name="PeliculaCategoria"
		, joinColumns={
			@JoinColumn(name="id")
			}
		, inverseJoinColumns={
			@JoinColumn(name="categoria_id")
			}
		)
	private List<Categoria> categorias;

	public Pelicula() {
	}

	public int getId() {
		return this.id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getActores() {
		return this.actores;
	}

	public void setActores(String actores) {
		this.actores = actores;
	}

	public String getArgumento() {
		return this.argumento;
	}

	public void setArgumento(String argumento) {
		this.argumento = argumento;
	}

	public String getDireccion() {
		return this.direccion;
	}

	public void setDireccion(String direccion) {
		this.direccion = direccion;
	}

	public String getImagen() {
		return this.imagen;
	}

	public void setImagen(String imagen) {
		this.imagen = imagen;
	}

	public String getTitulo() {
		return this.titulo;
	}

	public void setTitulo(String titulo) {
		this.titulo = titulo;
	}

	public String getTrailer() {
		return this.trailer;
	}

	public void setTrailer(String trailer) {
		this.trailer = trailer;
	}

	public List<Categoria> getCategorias() {
		return this.categorias;
	}

	public void setCategorias(List<Categoria> categorias) {
		this.categorias = categorias;
	}

}