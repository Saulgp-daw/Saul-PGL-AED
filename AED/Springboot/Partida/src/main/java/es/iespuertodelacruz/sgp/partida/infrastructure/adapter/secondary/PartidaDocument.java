package es.iespuertodelacruz.sgp.partida.infrastructure.adapter.secondary;

import org.springframework.data.mongodb.core.mapping.Document;

import org.springframework.data.annotation.Id;

@Document(collection="partidas")
public class PartidaDocument {

	@Id
	private String id_partida;
	
	private String estado;
	
	private String nick_jug1;
	
	private String nick_jug2;
	
	private String simbolo_jug1;
	
	private String simbolo_jug2;
	
	private String tablero;

	public PartidaDocument() {
		super();
	}

	public PartidaDocument(String id_partida, String estado, String nick_jug1, String nick_jug2, String simbolo_jug1,
			String simbolo_jug2, String tablero) {
		super();
		this.id_partida = id_partida;
		this.estado = estado;
		this.nick_jug1 = nick_jug1;
		this.nick_jug2 = nick_jug2;
		this.simbolo_jug1 = simbolo_jug1;
		this.simbolo_jug2 = simbolo_jug2;
		this.tablero = tablero;
	}

	public String getIdPartida() {
		return id_partida;
	}

	public void setIdPartida(String id_partida) {
		this.id_partida = id_partida;
	}

	public String getEstado() {
		return estado;
	}

	public void setEstado(String estado) {
		this.estado = estado;
	}

	public String getNick_jug1() {
		return nick_jug1;
	}

	public void setNick_jug1(String nick_jug1) {
		this.nick_jug1 = nick_jug1;
	}

	public String getNick_jug2() {
		return nick_jug2;
	}

	public void setNick_jug2(String nick_jug2) {
		this.nick_jug2 = nick_jug2;
	}

	public String getSimbolo_jug1() {
		return simbolo_jug1;
	}

	public void setSimbolo_jug1(String simbolo_jug1) {
		this.simbolo_jug1 = simbolo_jug1;
	}

	public String getSimbolo_jug2() {
		return simbolo_jug2;
	}

	public void setSimbolo_jug2(String simbolo_jug2) {
		this.simbolo_jug2 = simbolo_jug2;
	}

	public String getTablero() {
		return tablero;
	}

	public void setTablero(String tablero) {
		this.tablero = tablero;
	}
	
	
		
}
