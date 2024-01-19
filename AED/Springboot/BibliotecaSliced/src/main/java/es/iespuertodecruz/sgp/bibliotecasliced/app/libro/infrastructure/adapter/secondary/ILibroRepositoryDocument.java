package es.iespuertodecruz.sgp.bibliotecasliced.app.libro.infrastructure.adapter.secondary;

import org.springframework.data.mongodb.repository.MongoRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface ILibroRepositoryDocument extends MongoRepository<LibroDocument, String> {

	
}
