package es.iespuertodelacruz.jc.muchosamuchos;

import java.util.List;

import javax.persistence.EntityManager;
import javax.persistence.EntityManagerFactory;
import javax.persistence.Persistence;

import es.iespuertodelacruz.jc.muchosamuchos.entities.Conductor;

public class Main {

	public static void main(String args[]) {
		EntityManagerFactory emf = Persistence.createEntityManagerFactory("MuchosaMuchosJPA");
		EntityManager em = emf.createEntityManager();
		List<Conductor> lista = em.createNamedQuery("Conductor.findAll",Conductor.class).getResultList();
		lista.forEach(c->{
			System.out.println("conductor: " + c.getNombre() + ". Coches: ");
			c.getCoches().forEach(coche-> System.out.println(coche.getMatricula()));
		});
		
	}

}
