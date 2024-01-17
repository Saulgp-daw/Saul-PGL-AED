package es.iespuertodelacruz.sgp.tresenraya.service;

import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import es.iespuertodelacruz.sgp.tresenraya.dto.ApuestaDTO;
import es.iespuertodelacruz.sgp.tresenraya.entities.Partida;
import es.iespuertodelacruz.sgp.tresenraya.repository.IPartidaRepository;
import jakarta.transaction.Transactional;

@Service
public class PartidaService implements IGenericService<Partida, Integer> {
	
	@Autowired
	private IPartidaRepository partidaRepository;

	@Override
	public Iterable<Partida> findAll() {
		// TODO Auto-generated method stub
		return null;
	}

	@Override
	public Optional<Partida> findById(Integer id) {
		// TODO Auto-generated method stub
		return partidaRepository.findById(id);
	}

	@Override
	@Transactional
	public Partida save(Partida element) {
		// TODO Auto-generated method stub
		Partida partidaGuardada = null;
		try {
			partidaGuardada = partidaRepository.save(element);
			
		}catch (Exception ex) {
			System.out.println(ex);
		}
		return partidaGuardada;
	}

	@Override
	public void deleteById(Integer id) {
		// TODO Auto-generated method stub
		
	}
	
	@Transactional
	public Partida update(ApuestaDTO element) {
		Optional<Partida> partidaExistente = partidaRepository.findById(element.getIdPartida());
		//System.out.println("-------------------"+partidaExistente.get().getEstado());
		//System.out.println("-------------------"+element.getTablero());
		if(partidaExistente.isPresent()) {
			System.out.println("-------------------PRESENTE");
			partidaExistente.get().setTablero(element.getTablero());
		}
		
		return partidaExistente.get();
	}

}
