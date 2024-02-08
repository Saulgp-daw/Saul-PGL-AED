package reservas;

import java.util.List;

import javax.persistence.EntityManagerFactory;
import javax.persistence.Persistence;

import org.junit.jupiter.api.AfterAll;
import org.junit.jupiter.api.BeforeAll;
import org.junit.jupiter.api.Test;

import es.iespuertodelacruz.saul.entities.Usuario;
import es.iespuertodelacruz.saul.repositories.UsuarioRepository;

import static org.junit.jupiter.api.Assertions.assertNull;
import static org.junit.jupiter.api.Assertions.assertNotNull;
import static org.junit.jupiter.api.Assertions.assertTrue;


class UsuarioRepositoryTest {

	static EntityManagerFactory emf;
	static UsuarioRepository usuarioRepository;

	/**
	 * @throws java.lang.Exception
	 */
	@BeforeAll
	static void setUpBeforeClass() throws Exception {
		// EMFSingleton emfSingleton = EMFSingleton.getSingleton();
		// EntityManagerFactory emf = emfSingleton.getEmf();
		emf = Persistence.createEntityManagerFactory("TEST");

		usuarioRepository = new UsuarioRepository(emf);
	}

	/**
	 * @throws java.lang.Exception
	 */
	@AfterAll
	static void tearDownAfterClass() throws Exception {
	}

	@Test
	void test_find_all() {
		List<Usuario> todos = usuarioRepository.findAll();
		assertTrue(todos.size() > 0);
		
		Usuario usuario = todos.stream().filter(u->u.getNombre().equals("Saul")).findFirst().get();
		assertTrue(usuario.getNombre().equals("Saul"));
	}

}
