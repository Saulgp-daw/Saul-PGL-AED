package es.iespuertodecruz.sgp.bibliotecasliced.app.libro.domain;

public class Libro {
	
	public Libro() {
		
	}
	String id; 
	String titulo;
	int paginas;
	
	public String getId() {
		return id;
	}

	public void setId(String id) {
		this.id = id;
	}

	public String getTitulo() {
		return titulo;
	}

	public void setTitulo(String titulo) {
		this.titulo = titulo;
	}

	public int getPaginas() {
		return paginas;
	}

	public void setPaginas(int paginas) {
		this.paginas = paginas;
	}

	public Libro(String id, String titulo, int paginas) {
		super();
		this.id = id;
		this.titulo = titulo;
		this.paginas = paginas;
	}
	
	
}
