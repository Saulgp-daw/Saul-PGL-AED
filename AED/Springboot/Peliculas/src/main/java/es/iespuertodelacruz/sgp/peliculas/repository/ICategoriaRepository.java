package es.iespuertodelacruz.sgp.peliculas.repository;

import org.springframework.data.jpa.repository.JpaRepository;

import es.iespuertodelacruz.sgp.peliculas.entities.Categoria;

public interface ICategoriaRepository extends JpaRepository<Categoria, Integer>{

}
