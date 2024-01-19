package es.iespuertodecruz.sgp.bibliotecasliced.app.libro.infrastructure.adapter.secondary;

import org.springframework.data.annotation.Id;
import org.springframework.data.mongodb.core.mapping.Document;

@Document
public class LibroDocument {
		
		public LibroDocument() {
			
		}
		@Id
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

		public LibroDocument(String id, String titulo, int paginas) {
			super();
			this.id = id;
			this.titulo = titulo;
			this.paginas = paginas;
		
	}
}
