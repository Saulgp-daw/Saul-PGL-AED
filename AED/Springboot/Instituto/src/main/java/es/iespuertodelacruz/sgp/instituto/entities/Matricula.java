package es.iespuertodelacruz.sgp.instituto.entities;

import java.io.Serializable;
import jakarta.persistence.*;
import java.util.List;

import com.fasterxml.jackson.annotation.JsonIgnore;


/**
 * The persistent class for the matriculas database table.
 * 
 */
@Entity
@Table(name="matriculas")
@NamedQuery(name="Matricula.findAll", query="SELECT m FROM Matricula m")
public class Matricula implements Serializable {
	private static final long serialVersionUID = 1L;

	@Id
	@GeneratedValue(strategy=GenerationType.IDENTITY)
	private int id;

	private int year;

	//bi-directional many-to-one association to Alumno
	@JsonIgnore
	@ManyToOne
	@JoinColumn(name="dni")
	private Alumno alumno;

	//bi-directional many-to-many association to Asignatura
	//@ManyToMany(mappedBy="matriculas")
	//private List<Asignatura> asignaturas;
	
	
	@ManyToMany(fetch= FetchType.LAZY)
	@JoinTable(
		name="asignatura_matricula"
		,joinColumns={
			@JoinColumn(name="idmatricula")
			}
		, inverseJoinColumns={
			@JoinColumn(name="idasignatura")
			}
		)
	private List<Asignatura> asignaturas;

	public Matricula() {
	}

	public int getId() {
		return this.id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public int getYear() {
		return this.year;
	}

	public void setYear(int year) {
		this.year = year;
	}

	public Alumno getAlumno() {
		return this.alumno;
	}

	public void setAlumno(Alumno alumno) {
		this.alumno = alumno;
	}

	public List<Asignatura> getAsignaturas() {
		return this.asignaturas;
	}

	public void setAsignaturas(List<Asignatura> asignaturas) {
		this.asignaturas = asignaturas;
	}

}