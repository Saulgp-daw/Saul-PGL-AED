package es.iespuertodelacruz.jc.ejemplowebsocketseguro.documentrepository;

import java.util.List;

import org.springframework.data.mongodb.repository.MongoRepository;
import org.springframework.data.mongodb.repository.Query;
import org.springframework.stereotype.Repository;

import es.iespuertodelacruz.jc.ejemplowebsocketseguro.document.UsuarioDocument;

@Repository
public interface IUsuarioDocumentRepository extends MongoRepository<UsuarioDocument, String>{

	@Query("{ 'nombre' : ?0 }")
	public UsuarioDocument findByName(String nombre);
	
	
	public List<UsuarioDocument> findByRol(String rol);
	
	//void deleteByUserIdAndFriendId(ObjectId userId, ObjectId friendId);
}
