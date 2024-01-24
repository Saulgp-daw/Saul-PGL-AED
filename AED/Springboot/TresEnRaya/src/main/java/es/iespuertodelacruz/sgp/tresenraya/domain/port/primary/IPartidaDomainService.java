package es.iespuertodelacruz.sgp.tresenraya.domain.port.primary;

import java.util.Optional;

import es.iespuertodelacruz.sgp.tresenraya.domain.model.Partida;

public interface IPartidaDomainService {
	public Iterable<Partida> findAll();
	public Optional<Partida> findById(Integer id);
	public Partida save(Partida element);
	public void delete(Integer id);
	public Partida update(Integer id, )
	
}
