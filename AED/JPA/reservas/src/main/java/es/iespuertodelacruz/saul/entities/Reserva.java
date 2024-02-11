package es.iespuertodelacruz.saul.entities;

import java.io.Serializable;
import javax.persistence.*;
import java.math.BigInteger;


/**
 * The persistent class for the reservas database table.
 * 
 */
@Entity
@Table(name="reservas")
@NamedQuery(name="Reserva.findAll", query="SELECT r FROM Reserva r")
@NamedQuery(name="Reserva.findByEstado", query="SELECT r FROM Reserva r WHERE r.estado = :estado")
@NamedQuery(name="Reserva.findByTelefono", query="SELECT r FROM Reserva r WHERE r.usuario.telefono = :telefono")
//@NamedQuery(name= "Alumno.findAllRel", query = "SELECT a FROM Alumno a JOIN FETCH a.matriculas")
public class Reserva implements Serializable {
	@Override
	public String toString() {
		return "Reserva [idReserva=" + idReserva + ", duracion=" + duracion + ", estado=" + estado + ", fechaHora="
				+ fechaHora + ", mesa=" + mesa + ", usuario=" + usuario + "]";
	}

	private static final long serialVersionUID = 1L;

	@Id
	@GeneratedValue(strategy=GenerationType.IDENTITY)
	@Column(name="id_reserva")
	private int idReserva;

	private int duracion;

	private String estado;

	@Column(name="fecha_hora")
	private BigInteger fechaHora;

	//bi-directional many-to-one association to Mesa
	@ManyToOne
	@JoinColumn(name="num_mesa")
	private Mesa mesa;

	//bi-directional many-to-one association to Usuario
	@ManyToOne
	@JoinColumn(name="telefono")
	private Usuario usuario;

	public Reserva() {
	}

	public int getIdReserva() {
		return this.idReserva;
	}

	public void setIdReserva(int idReserva) {
		this.idReserva = idReserva;
	}

	public int getDuracion() {
		return this.duracion;
	}

	public void setDuracion(int duracion) {
		this.duracion = duracion;
	}

	public String getEstado() {
		return this.estado;
	}

	public void setEstado(String estado) {
		this.estado = estado;
	}

	public BigInteger getFechaHora() {
		return this.fechaHora;
	}

	public void setFechaHora(BigInteger fechaHora) {
		this.fechaHora = fechaHora;
	}

	public Mesa getMesa() {
		return this.mesa;
	}

	public void setMesa(Mesa mesa) {
		this.mesa = mesa;
	}

	public Usuario getUsuario() {
		return this.usuario;
	}

	public void setUsuario(Usuario usuario) {
		this.usuario = usuario;
	}

}