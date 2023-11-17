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
import es.iespuertodelacruz.saul.repositories.AlumnoRepository;
import es.iespuertodelacruz.saul.entities.Asignatura;
import es.iespuertodelacruz.saul.entities.Matricula;
import es.iespuertodelacruz.saul.entities.Alumno;

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
		alumnoRepository = new AlumnoRepository(emf);
	}

	static EntityManagerFactory emf;
	static MatriculaRepository matriculaRepository;
	static AsignaturaRepository asignaturaRepository;
	static AlumnoRepository alumnoRepository;

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
		Matricula encontrado = matriculaRepository.findById("1");
		assertNotNull(encontrado);
		assertTrue(encontrado.getId() == 1);
		assertNotNull(encontrado.getAsignaturas());
		assertTrue(encontrado.getAsignaturas().size() > 0);
	}

	@Test
	@Order(12)
	void test_find_by_idRel() {
		Matricula encontrado = matriculaRepository.findByIdRel("1");
		assertNotNull(encontrado);
		assertTrue(encontrado.getId() == 1);
	}
	
	
	
	@Test
	@Order(12)
	void test_update() {
		Matricula matriculaEncontrada = matriculaRepository.findByIdRel("1");
		Asignatura asignaturaEncontrada = asignaturaRepository.findById("4");


		assertNotNull(matriculaEncontrada); //estos 
		assertNotNull(asignaturaEncontrada);//dan ok
		
		List<Asignatura> nuevaLista = new ArrayList<Asignatura>();
		nuevaLista.add(asignaturaEncontrada);
		matriculaEncontrada.setAsignaturas(nuevaLista);
		boolean actualizada = matriculaRepository.update(matriculaEncontrada);
		assertTrue(actualizada); //este no da error tampoco
		
		Matricula mismaMatricula = matriculaRepository.findByIdRel("1");
		List<Asignatura> comprobar = mismaMatricula.getAsignaturas();
		assertTrue(comprobar.get(0).getId() == 4); //Este es donde se queja
		
	
	}
	
	@Test
	@Order(14)
	void test_save() {
		Alumno alumno = new Alumno();
		alumno.setDni("87654321X");
		alumno.setNombre("Marcos");
		alumno.setApellidos("Afonso Jiménez");
		alumno.setFechanacimiento(874278000000L);

		Asignatura asignatura = new Asignatura();
		asignatura.setCurso("Pistacho");
		asignatura.setNombre("Paloma");

		Matricula matricula = new Matricula();
		matricula.setYear(2077);
		matricula.setAlumno(alumno);

		List<Asignatura> list = new ArrayList<Asignatura>();
		list.add(asignatura);

		matricula.setAsignaturas(list);

		Matricula matriculasave = matriculaRepository.save(matricula);
		assertNotNull(matriculasave);
		assertTrue(matriculasave.getAsignaturas().size() == 1);
		assertTrue(matriculasave.getAlumno().getNombre().equals("Marcos"));



	
	}
	
	
	@Test
	@Order(14)
	void test_delete_by_id() {
		boolean borrado = matriculaRepository.deleteById("1");
		assertTrue(borrado);
		Matricula buscarBorrado = matriculaRepository.findById("1");
		assertNull(buscarBorrado);
	
	}
	
	
	
	

}
