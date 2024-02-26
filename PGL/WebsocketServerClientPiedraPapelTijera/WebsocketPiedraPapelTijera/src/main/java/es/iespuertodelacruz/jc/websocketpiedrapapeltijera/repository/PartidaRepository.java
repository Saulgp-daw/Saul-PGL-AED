package es.iespuertodelacruz.jc.websocketpiedrapapeltijera.repository;


import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.stereotype.Repository;

import es.iespuertodelacruz.jc.websocketpiedrapapeltijera.entity.PiedraPapelTijeraEntity;

@Repository
public interface PartidaRepository extends JpaRepository<PiedraPapelTijeraEntity, Integer>{

	@Query(   
			value = 
			" SELECT * FROM  "
			+ PiedraPapelTijeraEntity.TABLE_NAME + " p "
			+ " WHERE p.jugador2 IS NULL " ,
			
			nativeQuery = true
	)
	List<PiedraPapelTijeraEntity> findJuador2Null();
}
