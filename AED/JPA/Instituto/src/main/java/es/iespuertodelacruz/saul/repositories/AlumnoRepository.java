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
			try {
				EntityManager em = emf.createEntityManager();
				alumno = em.createNamedQuery("Alumno.findByDni", Alumno.class)
						.setParameter("dni", dni)
						.getSingleResult();
				
				if(alumno != null && alumno.getMatriculas() != null) {
					alumno.getMatriculas().size();
				}
				em.close();
			}catch(Exception ex) {
				return null;
			}
		}
		
		return alumno;
	}
	
	public Alumno findByName(String nombre) {
		Alumno alumno = null;
		if(nombre != null) {
			try {
				EntityManager em = emf.createEntityManager();
				alumno = em.createNamedQuery("Alumno.findByName", Alumno.class)
						.setParameter("nombre", nombre)
						.getSingleResult();
				
				if(alumno != null && alumno.getMatriculas() != null) {
					alumno.getMatriculas().size();
				}
				em.close();
			}catch(Exception ex) {
				return null;
			}
			
		}
		
		return alumno;
	}
	
	
	
	@Override
	public boolean deleteById(String dni) {
		boolean borrado = false;
		if(dni != null) {
			try {
				EntityManager em = emf.createEntityManager();
				Alumno find = em.find(Alumno.class, dni);
				if(find != null) {
					em.getTransaction().begin();
					if(find.getMatriculas().size() > 0 && find.getMatriculas() != null ) {
						throw new Exception("No se puede borrar el alumno porque tiene matriculas vinculadas");
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
	public boolean update(Alumno entity) {
		boolean actualizado = false;
		
		if(entity != null && entity.getMatriculas() != null) {
			EntityManager em = emf.createEntityManager();
			em.getTransaction().begin();
			Alumno alumnoActualizable = em.find(Alumno.class, entity.getMatriculas());
			if(alumnoActualizable != null) {
				alumnoActualizable.setNombre(entity.getNombre());
				alumnoActualizable.setApellidos(entity.getApellidos());
				alumnoActualizable.setFechanacimiento(entity.getFechanacimiento());
				em.getTransaction().commit();
				actualizado = true;
			}
			em.close();
		}
		
		return actualizado;
	}
	
	@Override
	public Alumno save(Alumno entity) {
		return null;
	}

	
}
