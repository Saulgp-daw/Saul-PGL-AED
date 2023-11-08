package es.iespuertodelacruz.monedas.entities;

import java.io.Serializable;
import javax.persistence.*;
import java.util.List;


/**
 * The persistent class for the monedas database table.
 * 
 */
@Entity
@Table(name="monedas")
@NamedQuery(name="Moneda.findAll", query="SELECT m FROM Moneda m")
public class Moneda implements Serializable {
	private static final long serialVersionUID = 1L;

	@Id
	@GeneratedValue(strategy=GenerationType.IDENTITY)
	@Column(unique=true, nullable=false)
	private int idmoneda;

	@Column(nullable=false, length=45)
	private String nombre;

	@Column(length=45)
	private String pais;

	//bi-directional many-to-one association to Historicocambioeuro
	@OneToMany(mappedBy="moneda")
	private List<Historicocambioeuro> historicocambioeuros;

	public Moneda() {
	}

	public int getIdmoneda() {
		return this.idmoneda;
	}

	public void setIdmoneda(int idmoneda) {
		this.idmoneda = idmoneda;
	}

	public String getNombre() {
		return this.nombre;
	}

	public void setNombre(String nombre) {
		this.nombre = nombre;
	}

	public String getPais() {
		return this.pais;
	}

	public void setPais(String pais) {
		this.pais = pais;
	}

	public List<Historicocambioeuro> getHistoricocambioeuros() {
		return this.historicocambioeuros;
	}

	public void setHistoricocambioeuros(List<Historicocambioeuro> historicocambioeuros) {
		this.historicocambioeuros = historicocambioeuros;
	}

	public Historicocambioeuro addHistoricocambioeuro(Historicocambioeuro historicocambioeuro) {
		getHistoricocambioeuros().add(historicocambioeuro);
		historicocambioeuro.setMoneda(this);

		return historicocambioeuro;
	}

	public Historicocambioeuro removeHistoricocambioeuro(Historicocambioeuro historicocambioeuro) {
		getHistoricocambioeuros().remove(historicocambioeuro);
		historicocambioeuro.setMoneda(null);

		return historicocambioeuro;
	}

}