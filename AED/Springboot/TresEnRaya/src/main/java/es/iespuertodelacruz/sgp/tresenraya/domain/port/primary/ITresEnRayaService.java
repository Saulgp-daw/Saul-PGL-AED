package es.iespuertodelacruz.sgp.tresenraya.domain.port.primary;

import es.iespuertodelacruz.sgp.tresenraya.entities.PartidaEntity;

public interface ITresEnRayaService {
	PartidaEntity findById(Integer id);
	
}
