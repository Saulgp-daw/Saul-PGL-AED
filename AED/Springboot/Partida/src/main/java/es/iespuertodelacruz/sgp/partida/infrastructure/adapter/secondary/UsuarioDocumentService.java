package es.iespuertodelacruz.sgp.partida.infrastructure.adapter.secondary;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;


@Service
public class UsuarioDocumentService {

	@Autowired IUsuarioDocumentRepository repository;
	
	public UsuarioDocument findByName(String nombre) {
		return repository.findByName(nombre);
	}
	
	public UsuarioDocument save(UsuarioDocument ud) {
		return repository.save(ud);
	}
	
	
	public List<UsuarioDocument> findByRol(String rol){
		return repository.findByRol(rol);
	}
	

}
