package es.iespuertodelacruz.saul.repositories;

import java.util.List;

import javax.persistence.EntityManager;
import javax.persistence.EntityManagerFactory;

import es.iespuertodelacruz.saul.entities.Alumno;

public class AlumnoRepository implements ICRUD<Alumno, String>{
	
	private EntityManagerFactory emf;
	
	public AlumnoRepository(EntityManagerFactory emf) {
		this.emf = emf;
	}
	
	public List<Alumno> findAll(){
		EntityManager em = emf.createEntityManager();
		List<Alumno> lista = em.createNamedQuery("Alumno.findAll", Alumno.class).getResultList();
		
		for(Alumno a: lista) {
			a.getMatriculas().size();
		}
		em.close();
		return lista;
		
	}
	
	
	public Alumno findById(String dni) {
		Alumno alumno = null;
		if(dni != null) {
			EntityManager em = emf.createEntityManager();
			alumno = em.createNamedQuery("Alumno.findByDni", Alumno.class)
					.setParameter(":dni", dni)
					.getSingleResult();
			
			if(alumno != null && alumno.getMatriculas() != null) {
				alumno.getMatriculas().size();
			}
			em.close();
		}
		
		return alumno;
	}
	public boolean deleteById(E id) {
		
	}
	boolean update(T entity);
	T save(T entity);
}
