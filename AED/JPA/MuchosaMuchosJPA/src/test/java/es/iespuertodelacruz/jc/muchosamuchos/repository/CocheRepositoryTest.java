package es.iespuertodelacruz.jc.muchosamuchos.repository;






import static org.junit.jupiter.api.Assertions.assertNotNull;
import static org.junit.jupiter.api.Assertions.assertNull;
import static org.junit.jupiter.api.Assertions.assertTrue;

import java.util.ArrayList;
import java.util.List;

import javax.persistence.EntityManagerFactory;
import javax.persistence.Persistence;

import org.junit.jupiter.api.AfterAll;
import org.junit.jupiter.api.BeforeAll;
import org.junit.jupiter.api.MethodOrderer;
import org.junit.jupiter.api.Order;
import org.junit.jupiter.api.Test;
import org.junit.jupiter.api.TestMethodOrder;

import es.iespuertodelacruz.jc.muchosamuchos.entities.Coche;
import es.iespuertodelacruz.jc.muchosamuchos.entities.Conductor;



/**
 * @author carlos
 *
 */
@TestMethodOrder(MethodOrderer.OrderAnnotation.class)
public class CocheRepositoryTest {

	/**
	 * @throws java.lang.Exception
	 */
	@BeforeAll
	static void setUpBeforeClass() throws Exception {
		//EMFSingleton emfSingleton = EMFSingleton.getSingleton();
		//EntityManagerFactory emf = emfSingleton.getEmf();
		emf = Persistence.createEntityManagerFactory("TEST");
		
		cocheRepository = new CocheRepository(emf);
	}

	static EntityManagerFactory emf;
	static CocheRepository cocheRepository;
	/**
	 * @throws java.lang.Exception
	 */
	@AfterAll
	static void tearDownAfterClass() throws Exception {
	}

	/**
	 * Test method for {@link es.iespuertodelacruz.jc.instituto.repository.AlumnoRepository#findById(java.lang.String)}.
	 */
	@Test()
	@Order(1)
	void testFindById() {
		

		Coche findById = cocheRepository.findById("matricula1");
		assertNotNull(findById);
		assertTrue(findById.getMatricula().equals("matricula1"));
		assertTrue(findById.getMarca().equals("marca1"));
		
	}

	/**
	 * Test method for {@link es.iespuertodelacruz.jc.instituto.repository.AlumnoRepository#save(es.iespuertodelacruz.jc.instituto.entities.Alumno)}.
	 */
	@Test
	@Order(3)
	void testSave() {

		Coche coche = new Coche();
		coche.setMarca("marcaprueba");
		coche.setMatricula("matriculaprueba");
		Coche save = cocheRepository.save(coche);
		assertNotNull(save);
		
		
		//verificamos el guardado en la tabla intermedia
		coche = new Coche();
		coche.setMarca("marcaprueba1");
		coche.setMatricula("matriculaprueba1");	
		ArrayList<Conductor> conductores = new ArrayList<Conductor>();
		
		//usamos un conductor que está en el sql de test
		Conductor conductor = new Conductor();
		conductor.setId(1);
		conductor.setNombre("conductor1");
		conductores.add(conductor);
		
		coche.setConductores(conductores);
		save = cocheRepository.save(coche);
		assertNotNull(save);
		
		Coche findById = cocheRepository.findById("matriculaprueba1");
		assertNotNull(findById.getConductores());
		System.out.println(findById.getConductores());
		
	}

	/**
	 * Test method for {@link es.iespuertodelacruz.jc.instituto.repository.AlumnoRepository#remove(java.lang.String)}.
	 */
	@Test
	@Order(5)
	void testRemove() {
		boolean okBorrado = cocheRepository.deleteById("matricula1");
		assertTrue(okBorrado);
		Coche findById1 = cocheRepository.findById("matricula1");
		assertNull(findById1);

	}

	/**
	 * Test method for {@link es.iespuertodelacruz.jc.instituto.repository.AlumnoRepository#update(es.iespuertodelacruz.jc.instituto.entities.Alumno)}.
	 */
	@Test
	@Order(4)
	void testUpdate() {
		Coche coche = new Coche();
		coche.setMarca("marcamodificada");
		coche.setMatricula("matricula1");	
		ArrayList<Conductor> conductores = new ArrayList<Conductor>();
		
		//usamos un conductor que está en el sql de test
		Conductor conductor = new Conductor();
		conductor.setId(2);
		conductor.setNombre("conductor2");
		conductores.add(conductor);
		coche.setConductores(conductores);
		
		boolean okUpdate = cocheRepository.update(coche);
		assertTrue(okUpdate);
		
		Coche findById = cocheRepository.findById("matricula1");
		assertTrue(coche.getMatricula().equals(findById.getMatricula()));
		assertTrue(coche.getMarca().equals(findById.getMarca()));
		assertTrue(coche.getConductores().size() == 1);
		assertTrue(coche.getConductores().get(0).getId() == 2);
	}

	/**
	 * Test method for {@link es.iespuertodelacruz.jc.instituto.repository.AlumnoRepository#findAll()}.
	 */
	@Test
	@Order(2)
	void testFindAll() {
		List<Coche> todos = cocheRepository.findAll();
		assertTrue(todos.size()==2);
		
		Coche coche = todos.stream().filter(c->c.getMatricula().equals("matricula1")).findFirst().get();
		assertTrue(coche.getMarca().equals("marca1"));	
		
		coche = todos.stream().filter(c->c.getMatricula().equals("matricula2")).findFirst().get();
		assertTrue(coche.getMarca().equals("marca2"));

	}

}
