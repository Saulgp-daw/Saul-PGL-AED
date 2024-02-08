package es.iespuertodelacruz.saul.repositories;

import java.util.List;

import javax.persistence.EntityManager;
import javax.persistence.EntityManagerFactory;

import es.iespuertodelacruz.saul.entities.Usuario;

public class UsuarioRepository implements ICRUD<Usuario, Integer> {
	
	private EntityManagerFactory emf;

	public UsuarioRepository(EntityManagerFactory emf) {
		this.emf = emf;
	}

	@Override
	public List<Usuario> findAll() {
		EntityManager em = emf.createEntityManager();
		List<Usuario> lista = em.createNamedQuery("Usuario.findAll",Usuario.class).getResultList();
		//cargamos la información de la tabla relacionada
		for(Usuario c : lista) {
			c.getReservas().size();
		}
		em.close();
		return lista;
	}

	@Override
	public Usuario findById(Integer id) {
		// TODO Auto-generated method stub
		return null;
	}

	@Override
	public boolean deleteById(Integer id) {
		// TODO Auto-generated method stub
		return false;
	}

	@Override
	public boolean update(Usuario entity) {
		// TODO Auto-generated method stub
		return false;
	}

	@Override
	public Usuario save(Usuario entity) {
		// TODO Auto-generated method stub
		return null;
	}

}
