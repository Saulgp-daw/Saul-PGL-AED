package es.iespuertodelacruz.saul.repositories;

import java.util.List;

import javax.persistence.EntityManager;
import javax.persistence.EntityManagerFactory;

import es.iespuertodelacruz.saul.entities.Alumno;
import es.iespuertodelacruz.saul.entities.Asignatura;
import es.iespuertodelacruz.saul.entities.Matricula;

public class AsignaturaRepository  implements ICRUD<Asignatura, String>{
	
private EntityManagerFactory emf;
	
	public AsignaturaRepository(EntityManagerFactory emf) {
		this.emf = emf;
	}

	@Override
	public List<Asignatura> findAll() {
		EntityManager em = emf.createEntityManager();
		List<Asignatura> lista = em.createNamedQuery("Asignatura.findAll", Asignatura.class).getResultList();
		
		em.close();
		return lista;
	}

	@Override
	public Asignatura findById(String id) {
		Asignatura asignatura = null;
		if(id != null) {
			EntityManager em = emf.createEntityManager();
			asignatura = em.find(Asignatura.class, Integer.parseInt(id));
			if(asignatura != null && asignatura.getMatriculas() != null) {
				asignatura.getMatriculas().size();
			}
			em.close();
		}
		return asignatura;
	}

	@Override
	public boolean deleteById(String id) {
		boolean borrado = false;
		if(id != null) {
			try {
				EntityManager em = emf.createEntityManager();
				Asignatura find = em.find(Asignatura.class, id);
				if(find != null) {
					em.getTransaction().begin();
					if(find.getMatriculas().size() > 0 && find.getMatriculas() != null ) {
						throw new Exception("No se puede borrar  porque tiene matriculas vinculadas");
					}
					em.remove(find);
					em.getTransaction().commit();
					borrado = true;
				}
				em.close();
			}catch(Exception ex) {
				ex.printStackTrace();
			}
		}
		return borrado;
	}

	@Override
	public boolean update(Asignatura entity) {
		// TODO Auto-generated method stub
		return false;
	}

	@Override
	public Asignatura save(Asignatura entity) {
		// TODO Auto-generated method stub
		return null;
	}

}
