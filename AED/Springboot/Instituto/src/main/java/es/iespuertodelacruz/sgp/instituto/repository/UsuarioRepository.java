package es.iespuertodelacruz.sgp.instituto.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

import es.iespuertodelacruz.sgp.instituto.entities.Usuario;

@Repository
public interface UsuarioRepository extends JpaRepository<Usuario, Integer> {
	@Query("SELECT u from Usuario u where u.nombre=:nombre")
	public Usuario findByName(@Param("nombre") String nombre);
	
	@Query("SELECT u from Usuario u WHERE u.email=:email")
	public Usuario findByEmail(@Param("email") String email);
}
