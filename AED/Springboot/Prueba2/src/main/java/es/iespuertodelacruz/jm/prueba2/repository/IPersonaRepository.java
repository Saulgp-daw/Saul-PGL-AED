package es.iespuertodelacruz.jm.prueba2.repository;

import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.stereotype.Repository;
import org.springframework.context.annotation.Configuration;

import es.iespuertodelacruz.jm.prueba2.entity.Persona;

@Repository
public interface IPersonaRepository extends JpaRepository<Persona, Integer>{

	@Query("SELECT p from Persona p WHERE p.nombre LIKE :name")
	public List<Persona>findByName(String name);
}
