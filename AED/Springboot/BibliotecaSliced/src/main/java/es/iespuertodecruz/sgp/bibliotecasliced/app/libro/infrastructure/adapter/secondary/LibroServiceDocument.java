package es.iespuertodecruz.sgp.bibliotecasliced.app.libro.infrastructure.adapter.secondary;

import java.util.List;
import java.util.stream.Collectors;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import es.iespuertodecruz.sgp.bibliotecasliced.app.libro.domain.Libro;
import es.iespuertodecruz.sgp.bibliotecasliced.app.libro.domain.port.secondary.ILibroRepositoryPort;

@Service
public class LibroServiceDocument implements ILibroRepositoryPort {
	@Autowired ILibroRepositoryDocument repository;
	
	LibroDocumentMapper mapper = new LibroDocumentMapper();
	

	@Override
	public List<Libro> findAll() {
		List<LibroDocument> lista = repository.findAll();
		return lista.stream()
				.map(ld -> mapper.toDomain(ld))
				.collect(Collectors.toList());
		
	}

	@Override
	public Libro save(Libro libro) {
		LibroDocument ld = mapper.toPersistence(libro);
		LibroDocument save = repository.save(ld);
		return mapper.toDomain(save);
	}
}
