package es.iespuertodelacruz.jpinicial;

import java.util.List;

import javax.persistence.EntityManager;
import javax.persistence.EntityManagerFactory;
import javax.persistence.Persistence;

import es.iespuertodelacruz.saul.entities.Alumno;

public class Main {

	public static void main(String[] args) {
	EntityManagerFactory emf = Persistence.createEntityManagerFactory("InstitutoPersistence");
	EntityManager em = emf.createEntityManager();


	}

}
