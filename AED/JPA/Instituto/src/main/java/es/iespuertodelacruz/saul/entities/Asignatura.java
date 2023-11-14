package es.iespuertodelacruz.saul.entities;

import java.io.Serializable;
import javax.persistence.*;
import java.util.List;


/**
 * The persistent class for the asignaturas database table.
 * 
 */
@Entity
@Table(name="asignaturas")
@NamedQuery(name="Asignatura.findAll", query="SELECT a FROM Asignatura a")
public class Asignatura implements Serializable {
	private static final long serialVersionUID = 1L;

	@Id
	@GeneratedValue(strategy=GenerationType.IDENTITY)
	private int id;

	private String curso;

	private String nombre;

	//bi-directional many-to-one association to AsignaturaMatricula
	@OneToMany(mappedBy="asignatura")
	private List<AsignaturaMatricula> asignaturaMatriculas;

	public Asignatura() {
	}

	public int getId() {
		return this.id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getCurso() {
		return this.curso;
	}

	public void setCurso(String curso) {
		this.curso = curso;
	}

	public String getNombre() {
		return this.nombre;
	}

	public void setNombre(String nombre) {
		this.nombre = nombre;
	}

	public List<AsignaturaMatricula> getAsignaturaMatriculas() {
		return this.asignaturaMatriculas;
	}

	public void setAsignaturaMatriculas(List<AsignaturaMatricula> asignaturaMatriculas) {
		this.asignaturaMatriculas = asignaturaMatriculas;
	}

	public AsignaturaMatricula addAsignaturaMatricula(AsignaturaMatricula asignaturaMatricula) {
		getAsignaturaMatriculas().add(asignaturaMatricula);
		asignaturaMatricula.setAsignatura(this);

		return asignaturaMatricula;
	}

	public AsignaturaMatricula removeAsignaturaMatricula(AsignaturaMatricula asignaturaMatricula) {
		getAsignaturaMatriculas().remove(asignaturaMatricula);
		asignaturaMatricula.setAsignatura(null);

		return asignaturaMatricula;
	}

}