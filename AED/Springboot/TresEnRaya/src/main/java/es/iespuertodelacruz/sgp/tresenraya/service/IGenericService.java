package es.iespuertodelacruz.sgp.tresenraya.service;

import java.util.Optional;

public interface IGenericService<T,E> {
	Iterable<T> findAll();
	Optional<T> findById(E id);
	T save(T element);
	void deleteById(E id);
}