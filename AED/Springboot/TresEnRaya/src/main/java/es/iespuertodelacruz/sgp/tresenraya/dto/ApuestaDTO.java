package es.iespuertodelacruz.sgp.tresenraya.dto;

public class ApuestaDTO {
	private int idPartida;
	private String tablero;
	
	
	public int getIdPartida() {
		return idPartida;
	}


	public void setIdPartida(int idPartida) {
		this.idPartida = idPartida;
	}


	public String getTablero() {
		return tablero;
	}


	public void setTablero(String tablero) {
		this.tablero = tablero;
	}


	public ApuestaDTO() {
		super();
	}


	public ApuestaDTO(int idPartida, String tablero) {
		super();
		this.idPartida = idPartida;
		this.tablero = tablero;
	}
}
