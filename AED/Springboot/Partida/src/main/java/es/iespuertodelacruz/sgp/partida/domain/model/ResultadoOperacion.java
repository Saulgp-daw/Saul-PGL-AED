package es.iespuertodelacruz.sgp.partida.domain.model;

public class ResultadoOperacion {
    private String mensaje;
    private Partida partida;

    public ResultadoOperacion(String mensaje, Partida partida) {
        this.mensaje = mensaje;
        this.partida = partida;
    }

	public String getMensaje() {
		return mensaje;
	}

	public void setMensaje(String mensaje) {
		this.mensaje = mensaje;
	}

	public Partida getPartida() {
		return partida;
	}

	public void setPartida(Partida partida) {
		this.partida = partida;
	}

}