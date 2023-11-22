package es.iespuertodelacruz.saul.repositories;

import java.util.ArrayList;
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
	
	public List<Alumno> findAllRel(){
		EntityManager em = emf.createEntityManager();
        List<Alumno> resultList = em.createNamedQuery("Alumno.findAllRel", Alumno.class).getResultList();
        if (resultList!=null){
            for (Alumno a:resultList) {
                if (a.getMatriculas()!=null && a.getMatriculas().size()>0){
                	a.getMatriculas().size();
                }
            }
        }
        em.close();
        return resultList;
		
	}
	
	public List<Alumno> findBySubName(String subname){
		EntityManager em = emf.createEntityManager();
        List<Alumno> resultList = em.createNamedQuery("Alumno.findBySubRel", Alumno.class)
        		.setParameter("nombre", subname)
        		.getResultList();
        
        if (resultList!=null){
            for (Alumno a:resultList) {
                if (a.getMatriculas()!=null && a.getMatriculas().size()>0){
                	a.getMatriculas().size();
                }
            }
        }
        em.close();
        return resultList;
	}
	
	public Alumno findById(String dni) {
		Alumno alumno = null;
		if(dni != null) {
			EntityManager em = emf.createEntityManager();
			alumno = em.find(Alumno.class, dni);
			if(alumno != null && alumno.getMatriculas() != null) {
				alumno.getMatriculas().size();
			}
			em.close();
		}
		return alumno;
	}
	
	
	public Alumno findByIdRel(String dni) {
		Alumno alumno = null;
		if(dni != null) {
			try {
				EntityManager em = emf.createEntityManager();
				alumno = em.createNamedQuery("Alumno.findByIdRel", Alumno.class)
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
	
	public boolean deleteByIdRel(String dni) {
		boolean borrado = false;
		if(dni != null) {
			try {
				EntityManager em = emf.createEntityManager();
				Alumno alumno = em.createNamedQuery("Alumno.findByIdRel", Alumno.class)
						.setParameter("dni", dni)
						.getSingleResult();
				
				if(alumno.getMatriculas().size() > 0 && alumno.getMatriculas() != null ) {
					throw new Exception("No se puede borrar el alumno porque tiene matriculas vinculadas");
				}
				em.remove(alumno);
				em.getTransaction().commit();
				borrado = true;
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
		
		if(entity != null && entity.getDni() != null) {
			try {
				EntityManager em = emf.createEntityManager();
				em.getTransaction().begin();
				Alumno alumnoActualizable = em.find(Alumno.class, entity.getDni());
				if(alumnoActualizable != null) {
					alumnoActualizable.setNombre(entity.getNombre());
					alumnoActualizable.setApellidos(entity.getApellidos());
					alumnoActualizable.setFechanacimiento(entity.getFechanacimiento());
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
	public Alumno save(Alumno entity) {
		Alumno alumno = null;
		try {
			EntityManager em = emf.createEntityManager();
			
			if(entity.getMatriculas() != null && entity.getMatriculas().size() > 0) {
				throw new Exception("No se admite el guardado en cascada");
			}
			em.getTransaction().begin();
			em.persist(entity);
			em.getTransaction().commit();
			em.close();
			alumno = entity;
			
		}catch(Exception ex) {
			ex.printStackTrace();
		}
		return alumno;
	}

	public List<Alumno> findAlumnoYear(String anho, int idAsignatura){
		List list = new ArrayList<Alumno>();
		if(anho != null && idAsignatura != 0){
				EntityManager em = emf.createEntityManager();
				//SELECT al.dni, al.nombre, al.apellidos, al.fechanacimiento, a.id, a.nombre, m.year
				//FROM matriculas m
				// INNER JOIN asignatura_matricula am
				// INNER JOIN asignaturas a
				// INNER JOIN alumnos al
				// ON al.dni = m.dni
				// AND a.id = am.idasignatura
				// AND m.id = am.idmatricula
				// WHERE m.year = 2006
				// AND a.id = 1
				list = em.createNativeQuery(
						"SELECT al.dni, al.nombre, al.apellidos, al.fechanacimiento, a.id, a.nombre, m.\"year\" " +
						"FROM matriculas m "
						+"INNER JOIN asignatura_matricula am "
						+"INNER JOIN asignaturas a "
						+"INNER JOIN alumnos al "
						+"ON al.dni = dni "
						+"AND a.id = am.idasignatura "
						+"AND m.id = am.idmatricula "
						+"WHERE m.\"year\" = ? "
						+"AND a.id = ?", Alumno.class)
						.setParameter(1,anho)
						.setParameter(2,idAsignatura)
						.getResultList();
		}
		return list;
	}

	
}
