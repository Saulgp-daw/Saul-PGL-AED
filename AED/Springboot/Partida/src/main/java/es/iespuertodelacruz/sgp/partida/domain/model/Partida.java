package es.iespuertodelacruz.sgp.partida.domain.model;

public class Partida {
	private int idPartida;
	private String estado;
	private String nickJug1;
	private String nickJug2;
	private String simboloJug1;
	private String simboloJug2;
	private String tablero;
	
	
	public Partida() {
		super();
	}


	public Partida(int idPartida, String estado, String nickJug1, String nickJug2, String simboloJug1,
			String simboloJug2, String tablero) {
		super();
		this.idPartida = idPartida;
		this.estado = estado;
		this.nickJug1 = nickJug1;
		this.nickJug2 = nickJug2;
		this.simboloJug1 = simboloJug1;
		this.simboloJug2 = simboloJug2;
		this.tablero = tablero;
	}


	public int getIdPartida() {
		return idPartida;
	}


	public void setIdPartida(int idPartida) {
		this.idPartida = idPartida;
	}


	public String getEstado() {
		return estado;
	}


	public void setEstado(String estado) {
		this.estado = estado;
	}


	public String getNickJug1() {
		return nickJug1;
	}


	public void setNickJug1(String nickJug1) {
		this.nickJug1 = nickJug1;
	}


	public String getNickJug2() {
		return nickJug2;
	}


	public void setNickJug2(String nickJug2) {
		this.nickJug2 = nickJug2;
	}


	public String getSimboloJug1() {
		return simboloJug1;
	}


	public void setSimboloJug1(String simboloJug1) {
		this.simboloJug1 = simboloJug1;
	}


	public String getSimboloJug2() {
		return simboloJug2;
	}


	public void setSimboloJug2(String simboloJug2) {
		this.simboloJug2 = simboloJug2;
	}


	public String getTablero() {
		return tablero;
	}


	public void setTablero(String tablero) {
		this.tablero = tablero;
	}
	
	
	
}
