package es.iespuertodecruz.sgp.bibliotecasliced.app.libro.domain.port.primary;

import java.util.List;

import es.iespuertodecruz.sgp.bibliotecasliced.app.libro.domain.Libro;

public interface ILibroServicePort {

	List <Libro> findAll();
	Libro save(Libro libro);
}
