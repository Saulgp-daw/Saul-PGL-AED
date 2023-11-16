package es.iespuertodelacruz.saul.repositories;

import java.util.ArrayList;
import java.util.List;

import javax.persistence.EntityManager;
import javax.persistence.EntityManagerFactory;

import es.iespuertodelacruz.saul.entities.Asignatura;
import es.iespuertodelacruz.saul.entities.Matricula;

public class MatriculaRepository implements ICRUD<Matricula, String>{
	
	private EntityManagerFactory emf;
	
	public MatriculaRepository(EntityManagerFactory emf) {
		this.emf = emf;
	}

	@Override
	public List<Matricula> findAll() {
		EntityManager em = emf.createEntityManager();
		List<Matricula> lista = em.createNamedQuery("Matricula.findAll", Matricula.class).getResultList();
		
		em.close();
		return lista;
	}
	
	public List<Matricula> findAllRel(){
		EntityManager em = emf.createEntityManager();
        List<Matricula> resultList = em.createNamedQuery("Matricula.findAll", Matricula.class).getResultList();
        if (resultList!=null){
            for (Matricula a:resultList) {
                if (a.getAsignaturas()!=null && a.getAsignaturas().size()>0){
                	a.getAsignaturas().size();
                }
            }
        }
        em.close();
        return resultList;
		
	}

	@Override
	public Matricula findById(String id) {
		Matricula matricula = null;
		if(id != null) {
			EntityManager em = emf.createEntityManager();
			matricula = em.find(Matricula.class, Integer.parseInt(id));
			if(matricula != null && matricula.getAsignaturas() != null) {
				matricula.getAsignaturas().size();
			}
			em.close();
		}
		return matricula;
	}
	
	public Matricula findByIdRel(String id) {
		Matricula matricula = null;
		if(id != null) {
			try {
				EntityManager em = emf.createEntityManager();
				matricula = em.createNamedQuery("Matricula.findByIdRel", Matricula.class)
						.setParameter("id", id)
						.getSingleResult();
				
				if(matricula != null && matricula.getAsignaturas()!= null) {
					matricula.getAsignaturas().size();
				}
				em.close();
			}catch(Exception ex) {
				return null;
			}
		}
		
		return matricula;
	}

	@Override
	public boolean deleteById(String id) {
		boolean borrado = false;
		if(id != null) {
			try {
				EntityManager em = emf.createEntityManager();
				Matricula find = em.find(Matricula.class, Integer.parseInt(id));
				
				if(find != null) {
					em.getTransaction().begin();
					if(find.getAsignaturas() != null && find.getAsignaturas().size() > 0) {
						for (Asignatura asignatura : find.getAsignaturas()) {
							asignatura.getMatriculas().remove(find);
						}
						find.getAsignaturas().clear();
						
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
	public boolean update(Matricula entity) {
		boolean actualizado = false;
		if(entity != null && entity.getId() != 0) {
			try {
				EntityManager em = emf.createEntityManager();
				Matricula matricula = em.find(Matricula.class, entity.getId());
				if(matricula != null) {
					em.getTransaction().begin();
					matricula.setYear(entity.getYear());
					
					if(matricula.getAsignaturas() != null && entity.getAsignaturas() != null && entity.getAsignaturas().size() > 0) {
						matricula.setAsignaturas(new ArrayList<Asignatura>());
						
						for (Asignatura asignatura : matricula.getAsignaturas()) {
							Asignatura find = em.find(Asignatura.class, asignatura.getId());
							find.getMatriculas().remove(entity);
						}
						
						for (Asignatura asignatura : entity.getAsignaturas()) {
							em.find(Asignatura.class, asignatura.getId());
							asignatura.getMatriculas().add(entity);
						}
					}
					
					
					em.merge(matricula);
					em.getTransaction().commit();
					actualizado = true;
				}
				em.close();
			}catch(Exception ex) {
				ex.printStackTrace();
			}
		}
		return actualizado;
	}

	@Override
	public Matricula save(Matricula entity) {
		// TODO Auto-generated method stub
		return null;
	}

}
