package es.iespuertodelacruz.sgp.partida.infrastructure.adapter.secondary;

import java.util.List;

import org.springframework.data.mongodb.repository.MongoRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface IPartidaRepositoryDocument extends MongoRepository<PartidaDocument, String>{
	List<PartidaDocument> findByEstado(String estado);

}
