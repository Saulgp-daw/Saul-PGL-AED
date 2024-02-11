package es.iespuertodelacruz.saul.repositories;

import java.util.ArrayList;
import java.util.Iterator;
import java.util.List;

import javax.persistence.EntityManager;
import javax.persistence.EntityManagerFactory;

import es.iespuertodelacruz.saul.entities.Reserva;
import es.iespuertodelacruz.saul.entities.Usuario;

public class UsuarioRepository implements ICRUD<Usuario, Integer> {

	private EntityManagerFactory emf;

	public UsuarioRepository(EntityManagerFactory emf) {
		this.emf = emf;
	}

	@Override
	public List<Usuario> findAll() {
		EntityManager em = emf.createEntityManager();
		List<Usuario> lista = em.createNamedQuery("Usuario.findAll", Usuario.class).getResultList();
		// cargamos la información de la tabla relacionada
		for (Usuario c : lista) {
			c.getReservas().size();
		}
		em.close();
		return lista;
	}

	@Override
	public Usuario findById(Integer id) {
		Usuario usuario = null;

		if (id != null) {
			EntityManager em = emf.createEntityManager();
			usuario = em.find(Usuario.class, id);

			if (usuario != null && usuario.getReservas() != null) {
				usuario.getReservas().size();
			}
			em.close();
		}
		return usuario;
	}

	// Delete one to many ejemplo
	@Override
	public boolean deleteById(Integer id) {
		boolean borrado = false;

		if (id != null) {
			try {
				EntityManager em = emf.createEntityManager();
				Usuario usuario = em.find(Usuario.class, id);
				if (usuario != null) {
					em.getTransaction().begin();

					Iterator<Reserva> iterator = usuario.getReservas().iterator();
					while (iterator.hasNext()) {
						Reserva reserva = iterator.next();
						iterator.remove();
						em.remove(reserva);
					}

					usuario.getReservas().clear();
					em.remove(usuario);
					em.getTransaction().commit();
					borrado = true;

				}
				em.close();
			} catch (Exception ex) {
				ex.printStackTrace();
			}
		}
		return borrado;
	}

	// Busca la lista para el trozo de nombre incluido
	public List<Usuario> findByNombre(String parteDelNombre) {
		EntityManager em = emf.createEntityManager();
		List<Usuario> lista = em
				.createQuery("SELECT u FROM Usuario u WHERE u.nombre LIKE CONCAT('%', :parteDelNombre, '%')",
						Usuario.class)
				.setParameter("parteDelNombre", parteDelNombre).getResultList();
		em.close();
		return lista;
	}

	@Override
	public boolean update(Usuario entity) {
		// TODO Auto-generated method stub
		return false;
	}

	@Override
	public Usuario save(Usuario entity) {
		Usuario usuario = null;
		try {
			EntityManager em = emf.createEntityManager();
			em.getTransaction().begin();
			if (entity.getReservas() != null && entity.getReservas().size() > 0) {
				throw new Exception("no se admite el guardado en cascada");
			}

			em.persist(entity);
			em.getTransaction().commit();
			em.close();
			usuario = entity;
		} catch (Exception ex) {
			ex.printStackTrace();
		}
		return usuario;
	}

}
