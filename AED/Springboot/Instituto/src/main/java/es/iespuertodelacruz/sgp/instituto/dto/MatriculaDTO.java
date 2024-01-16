package es.iespuertodelacruz.sgp.instituto.dto;

import java.util.List;

import es.iespuertodelacruz.sgp.instituto.entities.Asignatura;

public class MatriculaDTO {
	private String dni;
	private int year;
	private List<Asignatura> asignaturas;
	
	public String getDni() {
		return dni;
	}

	public void setDni(String dni) {
		this.dni = dni;
	}

	public int getYear() {
		return year;
	}

	public void setYear(int year) {
		this.year = year;
	}

	public List<Asignatura> getAsignaturas() {
		return asignaturas;
	}

	public void setAsignaturas(List<Asignatura> asignaturas) {
		this.asignaturas = asignaturas;
	}

	public MatriculaDTO(String dni, int year, List<Asignatura> asignaturas) {
		super();
		this.dni = dni;
		this.year = year;
		this.asignaturas = asignaturas;
	}

	public MatriculaDTO() {
		super();
	}
}
