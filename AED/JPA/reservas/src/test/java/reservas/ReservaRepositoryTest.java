package reservas;

import static org.junit.jupiter.api.Assertions.assertNotNull;
import static org.junit.jupiter.api.Assertions.assertTrue;

import java.net.Socket;
import java.time.LocalDate;
import java.util.List;

import javax.persistence.EntityManagerFactory;
import javax.persistence.Persistence;

import org.junit.jupiter.api.AfterAll;
import org.junit.jupiter.api.BeforeAll;
import org.junit.jupiter.api.Test;

import es.iespuertodelacruz.saul.entities.Reserva;
import es.iespuertodelacruz.saul.repositories.ReservaRepository;
import es.iespuertodelacruz.saul.repositories.UsuarioRepository;

class ReservaRepositoryTest {

	static EntityManagerFactory emf;
	static UsuarioRepository usuarioRepository;
	static ReservaRepository reservaRepository;

	/**
	 * @throws java.lang.Exception
	 */
	@BeforeAll
	static void setUpBeforeClass() throws Exception {
		// EMFSingleton emfSingleton = EMFSingleton.getSingleton();
		// EntityManagerFactory emf = emfSingleton.getEmf();
		emf = Persistence.createEntityManagerFactory("TEST");

		usuarioRepository = new UsuarioRepository(emf);
		reservaRepository = new ReservaRepository(emf);
	}

	/**
	 * @throws java.lang.Exception
	 */
	@AfterAll
	static void tearDownAfterClass() throws Exception {
	}
	
	@Test
	void test_find_by_id() {
		Reserva findById = reservaRepository.findById(1);
		assertNotNull(findById);
	}
	
	@Test
	void test_find_by_fecha() {
		List<Reserva> reservasFecha = reservaRepository.findReservasByDate(LocalDate.of(2023, 01, 01));
		assertNotNull(reservasFecha);
		System.out.println("HOLA-------------------------------");
		reservasFecha.forEach(reserva -> {
			Reserva reservaCorrecta = reservaRepository.findById(reserva.getIdReserva());
			assertNotNull(reservaCorrecta);
			assertTrue(reservaCorrecta.getIdReserva() == reserva.getIdReserva());
			assertTrue(reservaCorrecta.getDuracion() == reserva.getDuracion());
			System.out.println(reservaCorrecta.getFechaHora());
			System.out.println(reserva.getFechaHora());
			assertTrue(reservaCorrecta.getFechaHora().equals(reserva.getFechaHora()));
			assertTrue(reservaCorrecta.getUsuario().getTelefono() == reserva.getUsuario().getTelefono());
			
		});
		assertTrue(reservasFecha.size() > 0);
		
		
	}
	
	@Test
	void test_find_all() {
		List<Reserva> lista = reservaRepository.findAll();
		assertTrue(lista.size() > 0);
		Reserva reserva1 = lista.stream().filter(r->r.getIdReserva() == 1).findFirst().get();
		assertNotNull(reserva1);
	}
	
	@Test
	void test_find_by_estado() {
		String estado = "Sin confirmar";
		List<Reserva> find = reservaRepository.findByEstado(estado);
		assertTrue(find.size() > 0);
		
		find.forEach(reserva -> {
			assertTrue(reserva.getEstado().equals(estado));
		});
	}
	
	@Test
	void test_find_by_telefono() {
		Integer telefono = 890678456;
		List<Reserva> find = reservaRepository.findByTelefono(telefono);
		assertTrue(find.size() > 0);
		
		find.forEach(reserva -> {
			assertTrue(reserva.getUsuario().getTelefono() == telefono);
		});
	}
	
	
	

}
