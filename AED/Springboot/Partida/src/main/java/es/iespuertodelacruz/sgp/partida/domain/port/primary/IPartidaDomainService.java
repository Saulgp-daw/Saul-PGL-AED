package es.iespuertodelacruz.sgp.partida.domain.port.primary;

import java.util.List;

import es.iespuertodelacruz.sgp.partida.domain.model.Partida;

public interface IPartidaDomainService {
	List<Partida> findAll();
	Partida findById(Integer id);
	Partida save(Partida partida);
	
}
