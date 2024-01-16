package es.iespuertodelacruz.sgp.instituto.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import es.iespuertodelacruz.sgp.instituto.entities.Asignatura;

@Repository
public interface IAsignaturaRepository extends JpaRepository<Asignatura, Integer> {

}