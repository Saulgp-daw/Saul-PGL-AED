package es.iespuertodelacruz.jpainicial;

import java.math.BigDecimal;
import java.util.Date;
import java.util.List;

import javax.persistence.EntityManager;
import javax.persistence.EntityManagerFactory;
import javax.persistence.EntityTransaction;
import javax.persistence.Persistence;

import es.iespuertodelacruz.coche_conductores.Coche;
import es.iespuertodelacruz.coche_conductores.Conductor;
import es.iespuertodelacruz.monedas.entities.Historicocambioeuro;
import es.iespuertodelacruz.monedas.entities.Moneda;

public class Main {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		/*
		 * EntityManagerFactory emf =
		 * Persistence.createEntityManagerFactory("ProyectoMonedas"); EntityManager em =
		 * emf.createEntityManager(); em.getTransaction().begin(); List<Coche>
		 * listaCoches= em.createNamedQuery("Coche.findAll",
		 * Coche.class).getResultList(); List<Conductor> listaConductores=
		 * em.createNamedQuery("Conductor.findAll", Conductor.class).getResultList();
		 * Coche coche = listaCoches.get(0); coche.setConductores(listaConductores);
		 * em.getTransaction().commit(); em.close(); emf.close();
		 */
		EntityManagerFactory emf = Persistence.createEntityManagerFactory("ProyectoMonedas");
		EntityManager em = emf.createEntityManager();
		Moneda moneda = new Moneda();
		moneda.setNombre("Lira56");
		moneda.setPais("Turquía");
		em.getTransaction().begin();
		em.persist(moneda);
		for (int i = 0; i < 3; i++) {
			crearHistoricoDeMoneda(moneda.getIdmoneda(), em);
		}
		em.getTransaction().commit();
		em.close();
		System.out.println(moneda);
		System.out.println("lista de histórico: " + moneda.getHistoricocambioeuros());

	}

	public static Historicocambioeuro crearHistoricoDeMoneda(Integer idmoneda, EntityManager em) {
		Moneda moneda = em.find(Moneda.class, idmoneda);
		Historicocambioeuro h = new Historicocambioeuro();
		h.setEquivalenteeuro(new BigDecimal(Math.random() * 9));
		h.setFecha(new Date());
		h.setMoneda(moneda);
		EntityTransaction tr = (em.isJoinedToTransaction()) ? null : em.getTransaction();
		if (tr != null)
			tr.begin();
		em.persist(h);
		if (tr != null)
			tr.commit();
		System.out.println(h);
		return h;
	}

}
