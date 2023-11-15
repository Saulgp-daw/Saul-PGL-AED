package es.iespuertodelacruz.saul.repositorytests;

import static org.junit.jupiter.api.Assertions.*;

import javax.persistence.EntityManagerFactory;
import javax.persistence.Persistence;

import org.junit.jupiter.api.AfterAll;
import org.junit.jupiter.api.BeforeAll;
import org.junit.jupiter.api.MethodOrderer;
import org.junit.jupiter.api.Order;
import org.junit.jupiter.api.Test;
import org.junit.jupiter.api.TestMethodOrder;

import es.iespuertodelacruz.saul.entities.Alumno;
import es.iespuertodelacruz.saul.repositories.AlumnoRepository;

@TestMethodOrder(MethodOrderer.OrderAnnotation.class)
class AlumnoRepositoryTest {
	
	/**
	 * @throws java.lang.Exception
	 */
	@BeforeAll
	static void setUpBeforeClass() throws Exception {
		//EMFSingleton emfSingleton = EMFSingleton.getSingleton();
		//EntityManagerFactory emf = emfSingleton.getEmf();
		emf = Persistence.createEntityManagerFactory("TEST");
		
		alumnoRepository = new AlumnoRepository(emf);
	}

	static EntityManagerFactory emf;
	static AlumnoRepository alumnoRepository;
	/**
	 * @throws java.lang.Exception
	 */
	@AfterAll
	static void tearDownAfterClass() throws Exception {
	}

	@Test
	@Order(1)
	void test_save() {
		Alumno alumnoEncontrado = alumnoRepository.findById("12345678Z");
		assertNotNull(alumnoEncontrado);
		assertTrue(alumnoEncontrado.getDni().equals("12345678Z"));
		
	}

}
