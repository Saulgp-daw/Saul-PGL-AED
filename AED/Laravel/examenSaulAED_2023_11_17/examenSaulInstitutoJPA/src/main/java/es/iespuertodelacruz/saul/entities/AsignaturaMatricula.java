package es.iespuertodelacruz.saul.entities;

import java.io.Serializable;
import javax.persistence.*;


/**
 * The persistent class for the asignatura_matricula database table.
 * 
 */
@Entity
@Table(name="asignatura_matricula")
@NamedQuery(name="AsignaturaMatricula.findAll", query="SELECT a FROM AsignaturaMatricula a")
public class AsignaturaMatricula implements Serializable {
	private static final long serialVersionUID = 1L;

	@Id
	@GeneratedValue(strategy=GenerationType.IDENTITY)
	private int id;

	//bi-directional many-to-one association to Asignatura
	@ManyToOne
	@JoinColumn(name="idasignatura")
	private Asignatura asignatura;

	//bi-directional many-to-one association to Matricula
	@ManyToOne
	@JoinColumn(name="idmatricula")
	private Matricula matricula;

	public AsignaturaMatricula() {
	}

	public int getId() {
		return this.id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public Asignatura getAsignatura() {
		return this.asignatura;
	}

	public void setAsignatura(Asignatura asignatura) {
		this.asignatura = asignatura;
	}

	public Matricula getMatricula() {
		return this.matricula;
	}

	public void setMatricula(Matricula matricula) {
		this.matricula = matricula;
	}

}