package es.iespuertodelacruz.sgp.partida.infrastructure.adapter.secondary;

import java.util.List;
import java.util.stream.Collectors;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import es.iespuertodelacruz.sgp.partida.domain.model.Partida;
import es.iespuertodelacruz.sgp.partida.domain.port.secondary.IPartidaDomainRepository;

@Service
public class PartidaEntityService implements IPartidaDomainRepository{

	@Autowired IPartidaRepositoryEntity repository;
	
	PartidaEntityMapper mapper = new PartidaEntityMapper();
	
	@Override
	public List<Partida> findAll() {
		List<PartidaEntity> lista = repository.findAll();
		
		return lista.stream()
				.map(pe -> mapper.toDomain(pe))
				.collect(Collectors.toList());
	}

	@Override
	public Partida findById(Integer id) {
		// TODO Auto-generated method stub
		return null;
	}

	@Override
	public Partida save(Partida partida) {
		// TODO Auto-generated method stub
		return null;
	}

}
