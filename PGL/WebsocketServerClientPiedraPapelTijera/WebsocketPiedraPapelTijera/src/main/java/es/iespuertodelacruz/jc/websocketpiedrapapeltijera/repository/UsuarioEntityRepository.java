package es.iespuertodelacruz.jc.websocketpiedrapapeltijera.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.stereotype.Repository;

import es.iespuertodelacruz.jc.websocketpiedrapapeltijera.entity.UsuarioEntity;

@Repository
public interface UsuarioEntityRepository extends JpaRepository<UsuarioEntity, Integer>{
	@Query("""
			SELECT u FROM
			UsuarioEntity u
			WHERE u.nombre LIKE :nombre
			""")
	UsuarioEntity findByName(String nombre);

}
