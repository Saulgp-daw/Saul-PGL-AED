package es.iespuertodelacruz.saul.entities;

import java.io.Serializable;
import javax.persistence.*;
import java.util.List;


/**
 * The persistent class for the mesas database table.
 * 
 */
@Entity
@Table(name="mesas")
@NamedQuery(name="Mesa.findAll", query="SELECT m FROM Mesa m")
public class Mesa implements Serializable {
	private static final long serialVersionUID = 1L;

	@Id
	@GeneratedValue(strategy=GenerationType.IDENTITY)
	@Column(name="num_mesa")
	private int numMesa;

	private int sillas;

	//bi-directional many-to-one association to Reserva
	@OneToMany(mappedBy="mesa")
	private List<Reserva> reservas;

	public Mesa(int numMesa, int sillas) {
		super();
		this.numMesa = numMesa;
		this.sillas = sillas;
	}

	public Mesa() {
	}

	public int getNumMesa() {
		return this.numMesa;
	}

	public void setNumMesa(int numMesa) {
		this.numMesa = numMesa;
	}

	public int getSillas() {
		return this.sillas;
	}

	public void setSillas(int sillas) {
		this.sillas = sillas;
	}

	public List<Reserva> getReservas() {
		return this.reservas;
	}

	public void setReservas(List<Reserva> reservas) {
		this.reservas = reservas;
	}

	public Reserva addReserva(Reserva reserva) {
		getReservas().add(reserva);
		reserva.setMesa(this);

		return reserva;
	}

	public Reserva removeReserva(Reserva reserva) {
		getReservas().remove(reserva);
		reserva.setMesa(null);

		return reserva;
	}

}