package es.iespuertodelacruz.saul.repositories;
import java.util.List;

public interface ICRUD <T,E>{
	List<T> findAll();
	T findById(E id);
	boolean deleteById(E id);
	boolean update(T entity);
	T save(T entity);
}
