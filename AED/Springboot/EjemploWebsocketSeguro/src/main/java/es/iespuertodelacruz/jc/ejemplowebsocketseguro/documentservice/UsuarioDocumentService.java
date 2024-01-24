package es.iespuertodelacruz.jc.ejemplowebsocketseguro.documentservice;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import es.iespuertodelacruz.jc.ejemplowebsocketseguro.document.UsuarioDocument;
import es.iespuertodelacruz.jc.ejemplowebsocketseguro.documentrepository.IUsuarioDocumentRepository;

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
