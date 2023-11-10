package es.iespuertodelacruz.jc.muchosamuchos.repository;

import java.util.ArrayList;
import java.util.List;

import javax.persistence.EntityManager;
import javax.persistence.EntityManagerFactory;
import javax.persistence.TypedQuery;

import es.iespuertodelacruz.jc.muchosamuchos.entities.Coche;
import es.iespuertodelacruz.jc.muchosamuchos.entities.Conductor;

public class CocheRepository implements ICRUD<Coche,String>{

	private EntityManagerFactory emf;

	public CocheRepository(EntityManagerFactory emf) {
		this.emf = emf;
	}
	
	@Override
	public List<Coche> findAll() {
		EntityManager em = emf.createEntityManager();
		List<Coche> lista = em.createNamedQuery("Coche.findAll",Coche.class).getResultList();
		//cargamos la información de la tabla relacionada
		for(Coche c : lista) {
			c.getConductores().size();
		}
		em.close();
		return lista;
	}

	@Override
	public Coche findById(String id) {
		Coche resultado = null;
		if( id != null) {
			EntityManager em = emf.createEntityManager();
			resultado = em.find(Coche.class, id);
			//si está activado lazy al consultar por el tamaño 
			//de la lista de la otra tabla se ejecuta el sql y se obtiene en
			//la entity la lista relacionada
			if( resultado != null && resultado.getConductores() != null)
				resultado.getConductores().size();			
			em.close();
		}
		
		return resultado;
	}

	@Override
	public boolean deleteById(String id) {
		boolean ok = false;
		if( id != null) {
			EntityManager em = emf.createEntityManager();
			
			Coche find = em.find(Coche.class, id);
			if(find != null) {
				em.getTransaction().begin();
				if(find.getConductores() != null && find.getConductores().size() > 0) {
					
				}
				em.remove(find);
				em.getTransaction().commit();
				ok = true;
			}
			
			em.close();
		}
		return ok;
	}

	@Override
	public boolean update(Coche entity) {
		boolean ok = false;
		if( entity != null && entity.getMatricula() != null) {
			EntityManager em = emf.createEntityManager();
			
			Coche actualizable = em.find(Coche.class, entity.getMatricula());
			if(actualizable != null) {
				em.getTransaction().begin();
				actualizable.setMatricula(entity.getMatricula());
				actualizable.setMarca(entity.getMarca());
				if(entity.getConductores() != null && entity.getConductores().size() > 0) {
					actualizable.setConductores(new ArrayList<Conductor>());
					for( Conductor conductor : entity.getConductores()) {
						actualizable.getConductores().add(conductor);
					}
				}
				em.getTransaction().commit();
				ok = true;
			}
			
			em.close();
		}
		return ok;		
	}

	@Override
	public Coche save(Coche entity) {
		Coche coche = null;
		try {
			EntityManager em = emf.createEntityManager();
			if(entity.getConductores() != null && entity.getConductores().size()>0) {
				for(Conductor c: entity.getConductores()) {
					Conductor find = em.find(Conductor.class, c.getId());
					if(find == null)
						throw new Exception("no se admite el guardado en cascada de conductores");
				}
			}
			em.getTransaction().begin();
			em.persist(entity);
			em.getTransaction().commit();
			

			em.close();
			coche = entity;
		}catch(Exception ex) {
			ex.printStackTrace();
		}
		return coche;
	}
	
	

}
