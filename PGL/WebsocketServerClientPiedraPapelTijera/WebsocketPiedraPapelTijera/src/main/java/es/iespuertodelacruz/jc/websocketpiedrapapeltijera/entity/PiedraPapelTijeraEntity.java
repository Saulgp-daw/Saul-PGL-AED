package es.iespuertodelacruz.jc.websocketpiedrapapeltijera.entity;



import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.Table;

@Entity
@Table(name=PiedraPapelTijeraEntity.TABLE_NAME)
public class PiedraPapelTijeraEntity {
	public static final String TABLE_NAME = "partidas";  
	
	@Id
	@GeneratedValue(strategy=GenerationType.IDENTITY)
	@Column(unique=true, nullable=false)
	Integer id;
	
	String jugador1;
	String jugador2;
	
	String apuestaJugador1;
	String apuestaJugador2;
	
	String estado;
	
	String resultado;
	
	
	private static final String apuestasPosibles[] = {"PIEDRA", "PAPEL", "TIJERA"};
	
	public static final String posiblesEstados[] = { "FALTA JUGADOR 2",  "EN JUEGO", "FINALIZADA" };
	
	public PiedraPapelTijeraEntity() {}
	
	public PiedraPapelTijeraEntity(String jugador1) {
		estado = posiblesEstados[0];
		this.jugador1 = jugador1; 
	}
	
	
	public boolean establecerJugador2(String jugador2) {
		if( estado.equals(posiblesEstados[0])){
			if(jugador2.equals(jugador1))
				return false;
			if( jugador1 == null)
				return false;
		}else
			return false;
		
		
		
		this.jugador2 = jugador2;
		estado = posiblesEstados[1];
		return true;
	}
	
	public boolean apostar(String nombreJugador, String apuesta) {
		if( !estado.equals(posiblesEstados[1]) )
			return false;
		
		if( !nombreJugador.equals(jugador1) && !nombreJugador.equals(jugador2)) {
			return false;
		}
		
		if( nombreJugador.equals(jugador1) && apuestaJugador1 != null)
			return false;
		
		if( nombreJugador.equals(jugador2) && apuestaJugador2 != null)
			return false;
				
		if( nombreJugador.equals(jugador1)) {
			apuestaJugador1 = apuesta;
		}
		
		if( nombreJugador.equals(jugador2)) {
			apuestaJugador2 = apuesta;
		}		
		
		if( apuestaJugador1 != null && apuestaJugador2 != null)
			calcularGanador();
		
		return true;
	}
	
	public void calcularGanador() {
		if( apuestaJugador1 != null && apuestaJugador2 != null) {
			estado= posiblesEstados[2];
			resultado = jugador1 +": " + apuestaJugador1 + " " + jugador2 +": " + apuestaJugador2 +". ";
			
			switch( apuestaJugador1) {
			case "PIEDRA":
				switch(apuestaJugador2) {
					case "PIEDRA": resultado+= "empate. ";
					break;
					case "PAPEL": resultado += "gana " + jugador2;
					break;					
					case "TIJERA": resultado += "gana " + jugador1;
					break;					
				}
				break;
			case "PAPEL":
				switch(apuestaJugador2) {
				case "PIEDRA": resultado += "gana " + jugador1;
				break;
				case "PAPEL": resultado += "empate";
				break;					
				case "TIJERA": resultado += "gana " + jugador2;
				break;					
			}				
				break;
			case "TIJERA":
				switch(apuestaJugador2) {
				case "PIEDRA": resultado += "gana "+jugador2;
				break;
				case "PAPEL": resultado += "gana " + jugador1;
				break;					
				case "TIJERA": resultado += "empate";
				break;					
			}				
				break;
			}
		}
	}

	public Integer getId() {
		return id;
	}

	public void setId(Integer id) {
		this.id = id;
	}

	public String getJugador1() {
		return jugador1;
	}

	public void setJugador1(String jugador1) {
		this.jugador1 = jugador1;
	}

	public String getJugador2() {
		return jugador2;
	}

	public void setJugador2(String jugador2) {
		this.jugador2 = jugador2;
	}

	public String getApuestaJugador1() {
		return apuestaJugador1;
	}

	public void setApuestaJugador1(String apuestaJugador1) {
		this.apuestaJugador1 = apuestaJugador1;
	}

	public String getApuestaJugador2() {
		return apuestaJugador2;
	}

	public void setApuestaJugador2(String apuestaJugador2) {
		this.apuestaJugador2 = apuestaJugador2;
	}

	public String getEstado() {
		return estado;
	}

	public void setEstado(String estado) {
		this.estado = estado;
	}

	public String getResultado() {
		return resultado;
	}

	public void setResultado(String resultado) {
		this.resultado = resultado;
	}



	
}
