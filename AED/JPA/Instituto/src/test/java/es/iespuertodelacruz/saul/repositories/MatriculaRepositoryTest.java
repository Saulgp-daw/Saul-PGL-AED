package es.iespuertodelacruz.saul.repositories;

import static org.junit.jupiter.api.Assertions.*;

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

import es.iespuertodelacruz.saul.repositories.AsignaturaRepository;
import es.iespuertodelacruz.saul.entities.Asignatura;
import es.iespuertodelacruz.saul.entities.Matricula;

@TestMethodOrder(MethodOrderer.OrderAnnotation.class)
class MatriculaRepositoryTest {

	/**
	 * @throws java.lang.Exception
	 */
	@BeforeAll
	static void setUpBeforeClass() throws Exception {
		//EMFSingleton emfSingleton = EMFSingleton.getSingleton();
		//EntityManagerFactory emf = emfSingleton.getEmf();
		emf = Persistence.createEntityManagerFactory("TEST");
		
		matriculaRepository = new MatriculaRepository(emf);
		asignaturaRepository = new AsignaturaRepository(emf);
	}

	static EntityManagerFactory emf;
	static MatriculaRepository matriculaRepository;
	static AsignaturaRepository asignaturaRepository;
	/**
	 * @throws java.lang.Exception
	 */
	@AfterAll
	static void tearDownAfterClass() throws Exception {
	}
	
	@Test
	@Order(9)
	public void testFindAll(){
		List<Matricula> todos = matriculaRepository.findAll();
		assertTrue(todos.size() > 0);
	}
	
	@Test
	@Order(10)
	public void testFindAllRel(){
		 List<Matricula> allRel = matriculaRepository.findAllRel();
	        assertNotNull(allRel);
	        assertTrue(allRel.size() > 0);
	        
	}
	
	@Test
	@Order(11)
	void test_find_by_id() {
		Matricula encontrado = matriculaRepository.findById(1+"");
		assertNotNull(encontrado);
		assertTrue(encontrado.getId() == 1);
	}
	
	
	
	@Test
	@Order(12)
	void test_update() {
		Matricula matriculaEncontrada = matriculaRepository.findById("1");
		Asignatura asignaturaEncontrada = asignaturaRepository.findById("1");
		
		assertNotNull(matriculaEncontrada); //estos 
		assertNotNull(asignaturaEncontrada);//dan ok
		
		List<Asignatura> nuevaLista = new ArrayList<Asignatura>();
		nuevaLista.add(asignaturaEncontrada);
		matriculaEncontrada.setAsignaturas(nuevaLista);
		boolean actualizada = matriculaRepository.update(matriculaEncontrada);
		assertTrue(actualizada); //este no da error tampoco
		
		Matricula mismaMatricula = matriculaRepository.findById("1");
		List<Asignatura> comprobar = mismaMatricula.getAsignaturas();
		assertTrue(comprobar.get(0).getNombre().equals("BAE")); //Este es donde se queja
		
	
	}
	
	@Test
	@Order(14)
	void test_save() {
		
	
	}
	
	
	@Test
	@Order(14)
	void test_delete_by_id() {
		boolean borrado = matriculaRepository.deleteById(1+"");
		assertTrue(borrado);
	
	}
	
	
	
	

}
