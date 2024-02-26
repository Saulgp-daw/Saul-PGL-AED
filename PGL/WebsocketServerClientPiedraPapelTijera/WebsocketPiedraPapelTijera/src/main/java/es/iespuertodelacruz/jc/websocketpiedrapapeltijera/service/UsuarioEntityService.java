package es.iespuertodelacruz.jc.websocketpiedrapapeltijera.service;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import es.iespuertodelacruz.jc.websocketpiedrapapeltijera.entity.UsuarioEntity;
import es.iespuertodelacruz.jc.websocketpiedrapapeltijera.repository.UsuarioEntityRepository;

@Service
public class UsuarioEntityService {

	@Autowired UsuarioEntityRepository repository;

	public UsuarioEntity findByName(String nombre) {
		
		UsuarioEntity ue = repository.findByName(nombre);

		return ue;
	}


	@Transactional
	public UsuarioEntity save(UsuarioEntity usuario) {
		
		
		
		UsuarioEntity entitySaved = repository.save(usuario);

		return entitySaved;
	}

}
