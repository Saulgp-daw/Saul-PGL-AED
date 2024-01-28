package es.iespuertodelacruz.sgp.partida.infrastructure.adapter.secondary;

import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;

public interface IPartidaRepositoryEntity extends JpaRepository<PartidaEntity, Integer>{
	List<PartidaEntity> findByEstado(String estado);
}
