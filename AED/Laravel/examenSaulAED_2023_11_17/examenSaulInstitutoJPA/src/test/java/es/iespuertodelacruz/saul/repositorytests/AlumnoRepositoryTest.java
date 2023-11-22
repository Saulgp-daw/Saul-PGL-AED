package es.iespuertodelacruz.saul.repositorytests;

import static org.junit.jupiter.api.Assertions.*;

import java.util.List;

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
	public void testFindAll(){
		List<Alumno> todos = alumnoRepository.findAll();
		assertTrue(todos.size() > 0);
		
		Alumno alumno = todos.stream().filter(a->a.getDni().equals("12312312K")).findFirst().get();
		assertTrue(alumno.getNombre().equals("María Luisa"));
	}
	
	@Test
	@Order(2)
	public void testFindAllRel(){
		 List<Alumno> allRel = alumnoRepository.findAllRel();
	        assertNotNull(allRel);
	        assertTrue(allRel.size()==1);
	        for (Alumno m: allRel) {
	            assertTrue(m.getMatriculas().size()==1);
	        }
	}
	
	@Test
	@Order(2)
	public void testFindAllsubRel(){
		 List<Alumno> allRel = alumnoRepository.findBySubName("a");
	        assertNotNull(allRel);
	        assertTrue(allRel.size()==1);
	        for (Alumno m: allRel) {
	            assertTrue(m.getMatriculas().size()==1);
	        }
	}
	
	@Test
	@Order(3)
	void test_find_by_dni() {
		Alumno alumnoEncontrado = alumnoRepository.findById("12345678Z");
		assertNotNull(alumnoEncontrado);
		assertTrue(alumnoEncontrado.getDni().equals("12345678Z"));
	}

	@Test
	@Order(4)
	void test_find_by_dni_rel() {
		Alumno alumnoEncontrado = alumnoRepository.findByIdRel("12345678Z");
		assertNotNull(alumnoEncontrado);
		assertTrue(alumnoEncontrado.getDni().equals("12345678Z"));
	}
	
	@Test
	@Order(5)
	void test_find_by_name() {
		Alumno alumnoEncontrado = alumnoRepository.findByName("María Luisa");
		assertNotNull(alumnoEncontrado);
		assertTrue(alumnoEncontrado.getNombre().equals("María Luisa"));
	}
	
	@Test
	@Order(6)
	void test_delete_by_dni() {
		boolean alumnoBorrado = alumnoRepository.deleteById("87654321X");
		assertTrue(alumnoBorrado);
		Alumno alumnoEncontrado = alumnoRepository.findById("87654321X");
		assertNull(alumnoEncontrado);
	}
	
	@Test
	@Order(7)
	void test_actualizar_alumno() {
		Alumno alumnoActualizado = new Alumno();
		alumnoActualizado.setDni("12345678Z");
		alumnoActualizado.setNombre("Pepe");
		alumnoActualizado.setApellidos("Jonás");
		alumnoActualizado.setFechanacimiento(10002334353L);
		boolean actualizado = alumnoRepository.update(alumnoActualizado);
		assertTrue(actualizado);
	}
	
	@Test
	@Order(8)
    public void testSave() {
        Alumno nuevoAlumno = new Alumno();
        nuevoAlumno.setDni("34152546A");
        nuevoAlumno.setNombre("Ruben");
        nuevoAlumno.setApellidos("dwadwadw");
        nuevoAlumno.setFechanacimiento(321324231L);

        Alumno resultado = alumnoRepository.save(nuevoAlumno);

        assertNotNull(resultado);
        assertEquals(nuevoAlumno.getDni(), resultado.getDni());
        // Limpiar: eliminar la asignatura creada durante la prueba
        assertTrue(alumnoRepository.deleteById(resultado.getDni()));
    }

	@Test
	@Order(9)
	public void testNativeQuery() {
		List<Alumno> resultado = alumnoRepository.findAlumnoYear("2023", 2);
		assertNotNull(resultado);

	}
	
	@Test
	@Order(10)
	public void testDeleteByIdRel() {
		boolean alumnoBorrado = alumnoRepository.deleteByIdRel("12312312K");
		assertTrue(alumnoBorrado);

	}
	
	

}
