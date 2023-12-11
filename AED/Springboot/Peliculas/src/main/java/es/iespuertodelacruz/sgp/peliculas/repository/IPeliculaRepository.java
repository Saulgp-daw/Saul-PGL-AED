package es.iespuertodelacruz.sgp.peliculas.repository;

import java.util.List;
import java.util.Optional;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Modifying;
import org.springframework.data.jpa.repository.Query;
import org.springframework.stereotype.Repository;

import es.iespuertodelacruz.sgp.peliculas.entities.Pelicula;

@Repository
public interface IPeliculaRepository extends JpaRepository<Pelicula, Integer>{
	
	@Query("SELECT p from Pelicula p WHERE p.titulo LIKE :name")
	public List<Pelicula>findByName(String name);
	
	@Query("SELECT p FROM Pelicula AS p WHERE p.titulo LIKE :titulo")
	public List<Pelicula>findByNameNative(String titulo);
	
	@Query("DELETE FROM Pelicula WHERE id = :id")
	public void deleteById(int id);
	
	@Query(value = "DELETE FROM peliculacategoria WHERE pelicula_id = :id ", nativeQuery = true )
	public Boolean deleteIntermediaNative(int id); 
	
	@Query(value = "DELETE FROM peliculas WHERE id = :id ", nativeQuery = true )
	public Boolean deletePeliculaNative(int id); 
	
	@Modifying
	@Query(
			value = "INSERT INTO Peliculas (id, titulo, direccion, actores, argumento, imagen, trailer)"
					+ "VALUES (:id, :titulo, :direccion, :actores, :argumento, :imagen, :trailer);",
			nativeQuery = true		
	)
	Optional<Pelicula> saveNative(
			int id, 
			String titulo, 
			String direccion,
			String actores, 
			String imagen,
			String trailer
	);
	
	@Query(
			value = "UPDATE Peliculas AS p "
					+"JOIN PeliculaCategoria AS pc ON pc.pelicula_id = id "
					+"SET titulo = :titulo, direccion = :direccion, actores = :actores, argumento = :argumento, imagen = :imagen, trailer = :trailer, pc.categoria_id = :categoria_id"
					+"WHERE id = :id ",
					
			nativeQuery = true
			)
	public Boolean updateNative(
			int id,
			String titulo,
			String direccion,
			String actores,
			String imagen,
			String trailer,
			int categoria_id
	);
	
	
}
