package es.iespuertodelacruz.sgp.partida.infrastructure.adapter.primary.dto;

public class ApuestaDTO {
	private String simbolo;
	private int posicion;
	
	public ApuestaDTO() {
		super();
	}
	
	public int getPosicion() {
		return posicion;
	}

	public void setPosicion(int posicion) {
		this.posicion = posicion;
	}
	
	public String getSimbolo() {
		return simbolo;
	}

	public void setSimbolo(String simbolo) {
		this.simbolo = simbolo;
	}
}
