package es.iespuertodelacruz.saul.repositories;

import java.math.BigInteger;
import java.time.LocalDate;
import java.time.ZoneId;
import java.util.List;

import javax.persistence.EntityManager;
import javax.persistence.EntityManagerFactory;

import es.iespuertodelacruz.saul.entities.Reserva;

public class ReservaRepository implements ICRUD<Reserva, Integer>{
	
	private EntityManagerFactory emf;

	public ReservaRepository(EntityManagerFactory emf) {
		this.emf = emf;
	}

	@Override
	public List<Reserva> findAll() {
		EntityManager em = emf.createEntityManager();
		List<Reserva> lista = em.createNamedQuery("Reserva.findAll", Reserva.class).getResultList();
		em.close();
		return lista;
	}

	@Override
	public Reserva findById(Integer id) {
		Reserva reserva = null;
		if(id != null) {
			EntityManager em = emf.createEntityManager();
			reserva = em.find(Reserva.class, id);
			em.close();
		}
		return reserva;
	}
	
	public List<Reserva> findByEstado(String estado){
		EntityManager em = emf.createEntityManager();
		List<Reserva> lista = em.createNamedQuery("Reserva.findByEstado", Reserva.class)
				.setParameter("estado", estado)
				.getResultList();
				//.getSingleResult();
		em.close();
		return lista;
	}
	
	public List<Reserva> findByTelefono(Integer telefono){
		EntityManager em = emf.createEntityManager();
		List<Reserva> lista = em.createNamedQuery("Reserva.findByTelefono", Reserva.class)
				.setParameter("telefono", telefono)
				.getResultList();
		em.close();
		
		if (lista.isEmpty()) {
	        return null; // O puedes devolver una lista vacía: return new ArrayList<>();
	    } else {
	        return lista;
	    }
	}
	
	

	@Override
	public boolean deleteById(Integer id) {
		// TODO Auto-generated method stub
		return false;
	}

	@Override
	public boolean update(Reserva entity) {
		// TODO Auto-generated method stub
		return false;
	}

	@Override
	public Reserva save(Reserva entity) {
		// TODO Auto-generated method stub
		return null;
	}
	
	public List<Reserva> findReservasByDate(LocalDate fecha) {
	    EntityManager em = emf.createEntityManager();
	    try {
	        // Convertir LocalDate a inicio y fin del día en milisegundos desde la época
	    	long inicioDelDia = fecha.atStartOfDay(ZoneId.systemDefault()).toEpochSecond();
	    	long finDelDia = fecha.plusDays(1).atStartOfDay(ZoneId.systemDefault()).toEpochSecond() - 1;


	        System.out.println("Inicio del día: " + inicioDelDia);
	        System.out.println("Fin del día: " + finDelDia);
	        
	        String query = "SELECT * FROM reservas WHERE fecha_hora >= :inicioDelDia AND fecha_hora <= :finDelDia";
	        List<Reserva> reservas = em.createNativeQuery(query, Reserva.class)
	                                    .setParameter("inicioDelDia", BigInteger.valueOf(inicioDelDia))
	                                    .setParameter("finDelDia", BigInteger.valueOf(finDelDia))
	                                    .getResultList();
	        return reservas;
	    } finally {
	        if (em != null) {
	            em.close();
	        }
	    }
	}
	//ejemplo many-to-many (estas tablas no lo eran)
//	@Override
//	public boolean update(Matricula entity) {
//		boolean actualizado = false;
//		if(entity != null && entity.getId() != 0) {
//			try {
//				EntityManager em = emf.createEntityManager();
//				Matricula matricula = em.find(Matricula.class, entity.getId());
//				if(matricula != null) {
//					em.getTransaction().begin();
//					
//					if(matricula.getAsignaturas() != null && entity.getAsignaturas() != null
//							&& entity.getAsignaturas().size() > 0
//							&& entity != null) {
//
//						
//						for (Asignatura asignatura : matricula.getAsignaturas()) {
//							Asignatura find = em.find(Asignatura.class, asignatura.getId());
//							asignatura.getMatriculas().remove(entity);
//						}
//						
//						for (Asignatura asignatura : entity.getAsignaturas()) {
//							Asignatura find = em.find(Asignatura.class, asignatura.getId());
//							asignatura.getMatriculas().add(entity);
//						}
//					}
//					matricula.getAsignaturas().clear();
//					matricula.setAsignaturas(entity.getAsignaturas());
//					em.merge(matricula);
//					em.getTransaction().commit();
//					actualizado = true;
//				}
//				em.close();
//			}catch(Exception ex) {
//				ex.printStackTrace();
//			}
//		}
//		return actualizado;
//	}
	
//	@Override
//	public boolean update(Matricula entity) {
//		boolean actualizado = false;
//		if(entity != null && entity.getId() != 0) {
//			try {
//				EntityManager em = emf.createEntityManager();
//				Matricula matricula = em.find(Matricula.class, entity.getId());
//				if(matricula != null) {
//					em.getTransaction().begin();
//					
//					if(matricula.getAsignaturas() != null && entity.getAsignaturas() != null
//							&& entity.getAsignaturas().size() > 0
//							&& entity != null) {
//
//						
//						for (Asignatura asignatura : matricula.getAsignaturas()) {
//							Asignatura find = em.find(Asignatura.class, asignatura.getId());
//							asignatura.getMatriculas().remove(entity);
//						}
//						
//						for (Asignatura asignatura : entity.getAsignaturas()) {
//							Asignatura find = em.find(Asignatura.class, asignatura.getId());
//							asignatura.getMatriculas().add(entity);
//						}
//					}
//					matricula.getAsignaturas().clear();
//					matricula.setAsignaturas(entity.getAsignaturas());
//					em.merge(matricula);
//					em.getTransaction().commit();
//					actualizado = true;
//				}
//				em.close();
//			}catch(Exception ex) {
//				ex.printStackTrace();
//			}
//		}
//		return actualizado;
//	}

}
