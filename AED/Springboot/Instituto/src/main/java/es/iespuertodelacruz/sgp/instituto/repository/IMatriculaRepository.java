package es.iespuertodelacruz.sgp.instituto.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import es.iespuertodelacruz.sgp.instituto.entities.Matricula;

@Repository
public interface IMatriculaRepository extends JpaRepository<Matricula, Integer>{
	
}
