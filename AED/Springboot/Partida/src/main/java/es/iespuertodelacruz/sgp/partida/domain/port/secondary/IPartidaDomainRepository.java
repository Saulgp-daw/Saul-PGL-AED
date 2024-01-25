package es.iespuertodelacruz.sgp.partida.domain.port.secondary;

import java.util.List;

import es.iespuertodelacruz.sgp.partida.domain.model.Partida;

public interface IPartidaDomainRepository {
	List<Partida> findAll();
	Partida findById(Integer id);
	Partida save(Partida partida);
}
