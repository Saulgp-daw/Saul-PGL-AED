package es.iespuertodecruz.sgp.bibliotecasliced.app.libro.domain.port.secondary;

import java.util.List;

import es.iespuertodecruz.sgp.bibliotecasliced.app.libro.domain.Libro;

public interface ILibroRepositoryPort {

	List <Libro> findAll();
	Libro save(Libro libro);
}
