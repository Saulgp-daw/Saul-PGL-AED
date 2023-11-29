package es.iespuertodelacruz.jm.prueba2.repository;
import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.stereotype.Repository;
import org.springframework.context.annotation.Configuration;
import es.iespuertodelacruz.jm.prueba2.entity.Usuario;

@Repository

public interface IUsuarioRepository extends JpaRepository<Usuario, Integer>{

	@Query("SELECT u from Usuario u WHERE u.nombre LIKE :name")
	public List<Usuario>findByName(String name);
}



