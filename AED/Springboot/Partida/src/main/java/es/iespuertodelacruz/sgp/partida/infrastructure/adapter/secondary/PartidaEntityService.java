package es.iespuertodelacruz.sgp.partida.infrastructure.adapter.secondary;

import java.util.List;
import java.util.Optional;
import java.util.stream.Collectors;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import es.iespuertodelacruz.sgp.partida.domain.model.Partida;
import es.iespuertodelacruz.sgp.partida.domain.port.secondary.IPartidaDomainRepository;

@Service
public class PartidaEntityService implements IPartidaDomainRepository {

	@Autowired
	IPartidaRepositoryEntity peRepository;

	PartidaEntityMapper mapper = new PartidaEntityMapper();

	@Override
	public List<Partida> findAll() {
		List<PartidaEntity> lista = peRepository.findAll();

		return lista.stream().map(pe -> mapper.toDomain(pe)).collect(Collectors.toList());
	}

	@Override
	public Partida findById(Integer id) {
		Partida partida = null;
		if (id != null) {
			Optional<PartidaEntity> opt = peRepository.findById(id);
			if (opt.isPresent()) {
				PartidaEntity partidaEntity = opt.get();
				PartidaEntityMapper mapper = new PartidaEntityMapper();
				partida = mapper.toDomain(partidaEntity);

			}
		}
		return partida;
	}

	@Override
	public Partida save(Partida partida) {

		if (partida != null) {
			System.out.println("En domain service: "+partida.getSimboloJug1().length());
			PartidaEntity pe = mapper.toEntity(partida);
			System.out.println("En pe service: "+pe.getSimboloJug1());
			PartidaEntity save = peRepository.save(pe);
			return mapper.toDomain(save);
		}
		return null;
	}

}
