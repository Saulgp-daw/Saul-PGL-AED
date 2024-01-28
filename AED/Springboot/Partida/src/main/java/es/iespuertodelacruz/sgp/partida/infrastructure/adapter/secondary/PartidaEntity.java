package es.iespuertodelacruz.sgp.partida.infrastructure.adapter.secondary;

import java.io.Serializable;
import jakarta.persistence.*;


/**
 * The persistent class for the partidas database table.
 * 
 */
@Entity
@Table(name="partidas")
@NamedQuery(name="PartidaEntity.findAll", query="SELECT p FROM PartidaEntity p")
public class PartidaEntity implements Serializable {
	private static final long serialVersionUID = 1L;

	@Id
	@GeneratedValue(strategy=GenerationType.IDENTITY)
	@Column(name="id_partida")
	private int idPartida;

	private String estado;

	@Column(name="nick_jug1")
	private String nickJug1;

	@Column(name="nick_jug2")
	private String nickJug2;

	@Column(name="simbolo_jug1")
	private String simboloJug1;

	@Column(name="simbolo_jug2")
	private String simboloJug2;

	private String tablero;

	public PartidaEntity() {
	}

	public int getIdPartida() {
		return this.idPartida;
	}

	public void setIdPartida(int idPartida) {
		this.idPartida = idPartida;
	}

	public String getEstado() {
		return this.estado;
	}

	public void setEstado(String estado) {
		this.estado = estado;
	}

	public String getNickJug1() {
		return this.nickJug1;
	}

	public void setNickJug1(String nickJug1) {
		this.nickJug1 = nickJug1;
	}

	public String getNickJug2() {
		return this.nickJug2;
	}

	public void setNickJug2(String nickJug2) {
		this.nickJug2 = nickJug2;
	}

	public String getSimboloJug1() {
		return this.simboloJug1;
	}

	public void setSimboloJug1(String simboloJug1) {
		this.simboloJug1 = simboloJug1;
	}

	public String getSimboloJug2() {
		return this.simboloJug2;
	}

	public void setSimboloJug2(String simboloJug2) {
		this.simboloJug2 = simboloJug2;
	}

	public String getTablero() {
		return this.tablero;
	}

	public void setTablero(String tablero) {
		this.tablero = tablero;
	}

}