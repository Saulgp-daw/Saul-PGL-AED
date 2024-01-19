package es.iespuertodecruz.sgp.bibliotecasliced.app.libro.domain.service;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import es.iespuertodecruz.sgp.bibliotecasliced.app.libro.domain.Libro;
import es.iespuertodecruz.sgp.bibliotecasliced.app.libro.domain.port.primary.ILibroServicePort;
import es.iespuertodecruz.sgp.bibliotecasliced.app.libro.domain.port.secondary.ILibroRepositoryPort;

@Service
public class LibroServiceDomain implements ILibroServicePort{
	
	@Autowired ILibroRepositoryPort repository;

	@Override
	public List<Libro> findAll() {
		
		return repository.findAll();
	}

	@Override
	public Libro save(Libro libro) {
		return repository.save(libro);
	}
	
}
