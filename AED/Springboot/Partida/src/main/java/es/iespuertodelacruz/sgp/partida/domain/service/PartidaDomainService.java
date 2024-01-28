package es.iespuertodelacruz.sgp.partida.domain.service;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import es.iespuertodelacruz.sgp.partida.domain.model.Partida;
import es.iespuertodelacruz.sgp.partida.domain.port.primary.IPartidaDomainService;
import es.iespuertodelacruz.sgp.partida.domain.port.secondary.IPartidaDomainRepository;


@Service
public class PartidaDomainService implements IPartidaDomainService{
	
	@Autowired IPartidaDomainRepository partidaDomainRepository;

	@Override
	public List<Partida> findAll() {

		return partidaDomainRepository.findAll();
	}

	@Override
	public Partida findById(Integer id) {
		// TODO Auto-generated method stub
		return partidaDomainRepository.findById(id);
	}

	@Override
	public Partida save(Partida partida) {
		// TODO Auto-generated method stub
		return partidaDomainRepository.save(partida);
	}

	@Override
	public Partida update(Partida partida) {
		// TODO Auto-generated method stub
		return partidaDomainRepository.update(partida);
	}

	@Override
	public List<Partida> findByEstado(String estado) {
		// TODO Auto-generated method stub
		return partidaDomainRepository.findByEstado(estado);
	}
	
	

}
