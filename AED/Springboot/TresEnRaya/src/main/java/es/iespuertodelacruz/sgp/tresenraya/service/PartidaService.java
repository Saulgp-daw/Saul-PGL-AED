package es.iespuertodelacruz.sgp.tresenraya.service;

import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import es.iespuertodelacruz.sgp.tresenraya.dto.ApuestaDTO;
import es.iespuertodelacruz.sgp.tresenraya.entities.PartidaEntity;
import es.iespuertodelacruz.sgp.tresenraya.repository.IPartidaRepository;
import jakarta.transaction.Transactional;

@Service
public class PartidaService implements IGenericService<PartidaEntity, Integer> {
	
	@Autowired
	private IPartidaRepository partidaRepository;

	@Override
	public Iterable<PartidaEntity> findAll() {
		// TODO Auto-generated method stub
		return partidaRepository.findAll();
	}

	@Override
	public Optional<PartidaEntity> findById(Integer id) {
		// TODO Auto-generated method stub
		return partidaRepository.findById(id);
	}

	@Override
	@Transactional
	public PartidaEntity save(PartidaEntity element) {
		// TODO Auto-generated method stub
		PartidaEntity partidaGuardada = null;
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
	public PartidaEntity update(int id, String tablero) {
		Optional<PartidaEntity> partidaExistente = partidaRepository.findById(id);
		//System.out.println("-------------------"+partidaExistente.get().getEstado());
		//System.out.println("-------------------"+element.getTablero());
		if(partidaExistente.isPresent()) {
			System.out.println("-------------------PRESENTE");
			partidaExistente.get().setTablero(tablero);
		}
		
		return partidaExistente.get();
	}

}
