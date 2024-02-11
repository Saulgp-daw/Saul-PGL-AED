package reservas;

import static org.junit.jupiter.api.Assertions.assertNotNull;
import static org.junit.jupiter.api.Assertions.assertTrue;

import java.math.BigInteger;
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

import es.iespuertodelacruz.saul.entities.Mesa;
import es.iespuertodelacruz.saul.entities.Reserva;
import es.iespuertodelacruz.saul.entities.Usuario;
import es.iespuertodelacruz.saul.repositories.ReservaRepository;
import es.iespuertodelacruz.saul.repositories.UsuarioRepository;

@TestMethodOrder(MethodOrderer.OrderAnnotation.class)
class UsuarioRepositoryTest {

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
	@Order(1)
	void test_find_all() {
		List<Usuario> todos = usuarioRepository.findAll();
		assertTrue(todos.size() > 0);

		Usuario usuario = todos.stream().filter(u -> u.getNombre().equals("Saul")).findFirst().get();
		assertTrue(usuario.getNombre().equals("Saul"));
		assertTrue(usuario.getTelefono() == 689088259);
		Usuario usuario2 = todos.stream().filter(u -> u.getNombre().equals("Benito")).findFirst().get();
		assertTrue(usuario2.getNombre().equals("Benito"));
	}

	@Test
	@Order(2)
	void test_find_by_id() {
		Usuario usuario = usuarioRepository.findById(123456789);
		assertNotNull(usuario);
		assertTrue(usuario.getNombre().equals("Juan Perez"));
		List<Reserva> lista = usuario.getReservas();

		lista.forEach(reserva -> {
			assertTrue(reserva.getUsuario().getNombre().equals(usuario.getNombre()));
			Reserva reservaCorrecta = reservaRepository.findById(reserva.getIdReserva());
			assertNotNull(reservaCorrecta);
			assertTrue(reservaCorrecta.getIdReserva() == reserva.getIdReserva());
			assertTrue(reservaCorrecta.getEstado().equals(reserva.getEstado()));
			assertTrue(reservaCorrecta.getDuracion() == reserva.getDuracion());
		});
	}

	@Test
	@Order(3)
	void test_delete_usuario() {
		boolean deleteById = usuarioRepository.deleteById(123456789);
		assertTrue(deleteById);
		Usuario usuario = usuarioRepository.findById(123456789);
		assertTrue(usuario == null);
		List<Reserva> reservas = reservaRepository.findByTelefono(123456789);

		// assertNotNull(reservas);
		assertTrue(reservas == null);

	}

	@Test
	@Order(4)
	void test_find_parte_nombre() {
		List<Usuario> lista = usuarioRepository.findByNombre("Sa");
		assertTrue(lista.size() > 0);
		Usuario usuario = lista.stream().filter(u -> u.getNombre().contains("Sa")).findFirst().get();
		assertNotNull(usuario);
		assertTrue(usuario.getNombre().equals("Saul"));
		assertTrue(usuario.getTelefono() == 689088259);
	}

	@Test
	@Order(5)
	void test_save() {
		//usuario nuevo sin reservas vinculadas
		Usuario usuario = new Usuario();
		usuario.setNombre("Pepe");
		usuario.setTelefono(686634923);
		usuario.setContrasenha("1234");
		usuario.setRol("CLIENTE");

		Usuario save = usuarioRepository.save(usuario);
		assertNotNull(save);

		// verificamos si se ha guardado en la tabla
		Usuario guardado = usuarioRepository.findById(686634923);
		assertNotNull(guardado);
		assertTrue(guardado.getNombre().equals(usuario.getNombre()));
		assertTrue(guardado.getTelefono() == usuario.getTelefono());
		assertTrue(guardado.getRol().equals(usuario.getRol()));
		
		//usuario nuevo con reservas vinculadas
		Usuario usuarioConReservas = new Usuario();
		usuarioConReservas.setNombre("Jaime");
		usuarioConReservas.setTelefono(686634922);
		usuarioConReservas.setContrasenha("1234");
		usuarioConReservas.setRol("CLIENTE");

		List<Reserva> reservas = new ArrayList<>();
		Reserva nueva = new Reserva();
		nueva.setFechaHora(BigInteger.valueOf(1708209300));
		nueva.setDuracion(2);
		nueva.setEstado("Confirmada");
		nueva.setMesa(new Mesa(100, 5));
		nueva.setIdReserva(1000);

		reservas.add(nueva);

		usuarioConReservas.setReservas(reservas);

		Usuario guardadoConReservas = usuarioRepository.save(usuarioConReservas);
		//devuelve null por la excepción
		assertTrue(guardadoConReservas == null);
//		Usuario guardadoConReservasFind = usuarioRepository.findById(guardadoConReservas.getTelefono());
//		assertNotNull(guardadoConReservasFind);
//		assertTrue(guardadoConReservas.getTelefono() == guardadoConReservasFind.getTelefono());
//		
//		assertTrue(guardadoConReservas.getReservas().size() > 0);
//		assertTrue(guardadoConReservasFind.getReservas().size() > 0);

		
	}

}
