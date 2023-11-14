package es.iespuertodelacruz.saul.entities;

import java.io.Serializable;
import javax.persistence.*;
import java.util.List;


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

	//bi-directional many-to-one association to AsignaturaMatricula
	@OneToMany(mappedBy="matricula")
	private List<AsignaturaMatricula> asignaturaMatriculas;

	//bi-directional many-to-one association to Alumno
	@ManyToOne
	@JoinColumn(name="dni")
	private Alumno alumno;

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

	public List<AsignaturaMatricula> getAsignaturaMatriculas() {
		return this.asignaturaMatriculas;
	}

	public void setAsignaturaMatriculas(List<AsignaturaMatricula> asignaturaMatriculas) {
		this.asignaturaMatriculas = asignaturaMatriculas;
	}

	public AsignaturaMatricula addAsignaturaMatricula(AsignaturaMatricula asignaturaMatricula) {
		getAsignaturaMatriculas().add(asignaturaMatricula);
		asignaturaMatricula.setMatricula(this);

		return asignaturaMatricula;
	}

	public AsignaturaMatricula removeAsignaturaMatricula(AsignaturaMatricula asignaturaMatricula) {
		getAsignaturaMatriculas().remove(asignaturaMatricula);
		asignaturaMatricula.setMatricula(null);

		return asignaturaMatricula;
	}

	public Alumno getAlumno() {
		return this.alumno;
	}

	public void setAlumno(Alumno alumno) {
		this.alumno = alumno;
	}

}