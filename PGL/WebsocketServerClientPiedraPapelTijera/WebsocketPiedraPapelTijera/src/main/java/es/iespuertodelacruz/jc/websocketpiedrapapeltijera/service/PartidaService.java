package es.iespuertodelacruz.jc.websocketpiedrapapeltijera.service;

import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import es.iespuertodelacruz.jc.websocketpiedrapapeltijera.entity.PiedraPapelTijeraEntity;
import es.iespuertodelacruz.jc.websocketpiedrapapeltijera.repository.PartidaRepository;

@Service
public class PartidaService {

	@Autowired PartidaRepository repository;

	public PiedraPapelTijeraEntity findById(Integer id) {
		Optional<PiedraPapelTijeraEntity> opt = repository.findById(id);
		return opt.orElse(null);
	}


	public List<PiedraPapelTijeraEntity> findJugador2Null(){
		return repository.findJuador2Null();
	}
	
	@Transactional
	public PiedraPapelTijeraEntity save(PiedraPapelTijeraEntity partida) {
		PiedraPapelTijeraEntity entitySaved = repository.save(partida);
		return entitySaved;
	}

}
