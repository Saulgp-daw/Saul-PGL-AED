package es.iespuertodelacruz.sgp.partida.domain.model;

public class Partida {
	private String id_partida;
	private String estado;
	private String nickJug1;
	private String nickJug2;
	private String simboloJug1;
	private String simboloJug2;
	private String tablero;
	
	
	public Partida() {
		super();
	}


	public Partida(String id_partida, String estado, String nickJug1, String nickJug2, String simboloJug1,
			String simboloJug2, String tablero) {
		super();
		this.id_partida = id_partida;
		this.estado = estado;
		this.nickJug1 = nickJug1;
		this.nickJug2 = nickJug2;
		this.simboloJug1 = simboloJug1;
		this.simboloJug2 = simboloJug2;
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
	
	public String apuesta(String simbolo, int posicion) {
		long cantSimb1 = this.tablero.chars().filter(ch -> ch == this.getSimboloJug1().charAt(0)).count();
		long cantSimb2 = this.tablero.chars().filter(ch -> ch == this.getSimboloJug2().charAt(0)).count();
		
		if (this.getEstado().equals("FINALIZADA")) {
	       return "FINALIZADA";
	    } else if(this.getEstado().equals("EMPATE")) {
			 return "EMPATE";
		}
		
		if (this.tablero.charAt(posicion) != '-') {
			 return "COGIDA";
	    }
		
		if(cantSimb1 > cantSimb2 && this.getSimboloJug1().equals(simbolo)) {
			 return "TURNO";
		}else if(cantSimb2 > cantSimb1 && this.getSimboloJug2().equals(simbolo) || cantSimb2 == cantSimb1 && this.getSimboloJug2().equals(simbolo)) {
			 return "TURNO";
		}else {
			this.setTablero(this.reemplazarCaracter(simbolo.toString(), posicion));
			this.turnoBOT();
			if(this.verificarVictoria()) {
				 this.setEstado("FINALIZADA");
			}else if(this.tableroLleno()) {
				this.setEstado("EMPATE");
			}
			return "OK";
		}
	}
	
	public void turnoBOT() {
		if(this.getNickJug2().equals("BOT") && !this.tableroLleno()) {
			char[] tableroArray = this.getTablero().toCharArray();
			System.out.println(tableroArray.length);
			int rndPos = 0 ;
			do {
			    rndPos = (int) Math.floor(Math.random() * (tableroArray.length - 1));
			} while (tableroArray[rndPos] != '-');
			this.setTablero(this.reemplazarCaracter(this.getSimboloJug2(), rndPos));
			System.out.println("Pos aleatoria: "+ rndPos);
		}
	}
	
	public String reemplazarCaracter(String simbolo, int posicion) {
		if (posicion < 0 || posicion > this.getTablero().length()) {
			throw new IllegalArgumentException("Posición fuera de rango");
		}

		char[] caracteres = this.getTablero().toCharArray();
		caracteres[posicion] = simbolo.charAt(0);

		return new String(caracteres);
	}
	
	private boolean verificarVictoria() {
		 // Posiciones ganadoras: 3 filas, 3 columnas, 2 diagonales
	    int[][] lineasGanadoras = {
	        {0, 1, 2}, {3, 4, 5}, {6, 7, 8}, // filas
	        {0, 3, 6}, {1, 4, 7}, {2, 5, 8}, // columnas
	        {0, 4, 8}, {2, 4, 6}             // diagonales
	    };

	    for (int[] linea : lineasGanadoras) {
	        if (tablero.charAt(linea[0]) != '-' &&
	            tablero.charAt(linea[0]) == tablero.charAt(linea[1]) &&
	            tablero.charAt(linea[1]) == tablero.charAt(linea[2])) {
	            return true;
	        }
	    }

	    return false;
	   
	}
	
	private boolean tableroLleno() {
	    return !this.tablero.contains("-");
	}
	
	
	
}
