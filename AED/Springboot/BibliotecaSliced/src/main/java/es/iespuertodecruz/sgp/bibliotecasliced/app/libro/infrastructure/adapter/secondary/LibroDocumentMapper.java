package es.iespuertodecruz.sgp.bibliotecasliced.app.libro.infrastructure.adapter.secondary;

import es.iespuertodecruz.sgp.bibliotecasliced.app.libro.domain.Libro;

public class LibroDocumentMapper {

	public Libro toDomain(LibroDocument ld) {
		Libro libro = null;
		if(ld != null) {
			libro = new Libro();
			libro.setId(ld.getId());
			libro.setPaginas(ld.getPaginas());
			libro.setTitulo(ld.getTitulo());
		}
		
		return libro;
	}
	
	public LibroDocument toPersistence(Libro libro) {
		LibroDocument ld = null;
		if(libro != null) {
			ld = new LibroDocument();
			ld.setId(libro.getId());
			ld.setPaginas(libro.getPaginas());
			ld.setTitulo(libro.getTitulo());
		}
		
		return ld;
	}
}
