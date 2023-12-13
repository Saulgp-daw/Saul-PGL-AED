package es.iespuertodelacruz.sgp.peliculas.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import es.iespuertodelacruz.sgp.peliculas.entities.Categoria;

@Repository
public interface ICategoriaRepository extends JpaRepository<Categoria, Integer>{

}
