package es.iespuertodelacruz.jc.muchosamuchos.entities;

import java.io.Serializable;
import javax.persistence.*;
import java.util.List;


/**
 * The persistent class for the coches database table.
 * 
 */
@Entity
@Table(name="coches")
@NamedQuery(name="Coche.findAll", query="SELECT c FROM Coche c")
public class Coche implements Serializable {
	private static final long serialVersionUID = 1L;

	@Id
	@Column(unique=true, nullable=false, length=30)
	private String matricula;

	@Column(length=100)
	private String marca;



	//bi-directional many-to-many association to Conductore
	@ManyToMany
	@JoinTable(
		name="coche_conductor"
		, joinColumns={
			@JoinColumn(name="matricula")
			}
		, inverseJoinColumns={
			@JoinColumn(name="idconductor")
			}
		)
	private List<Conductor> conductores;

	public Coche() {
	}

	public String getMatricula() {
		return this.matricula;
	}

	public void setMatricula(String matricula) {
		this.matricula = matricula;
	}

	public String getMarca() {
		return this.marca;
	}

	public void setMarca(String marca) {
		this.marca = marca;
	}

	



	public List<Conductor> getConductores() {
		return this.conductores;
	}

	public void setConductores(List<Conductor> conductores) {
		this.conductores = conductores;
	}

}