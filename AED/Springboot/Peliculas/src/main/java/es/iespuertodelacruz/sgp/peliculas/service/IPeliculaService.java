package es.iespuertodelacruz.sgp.peliculas.service;

import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import es.iespuertodelacruz.sgp.peliculas.entities.Categoria;
import es.iespuertodelacruz.sgp.peliculas.entities.Pelicula;
import es.iespuertodelacruz.sgp.peliculas.repository.IPeliculaRepository;
import jakarta.transaction.Transactional;

@Service
public class IPeliculaService implements IGenericService<Pelicula, Integer> {

	@Autowired
	private IPeliculaRepository peliculaRepository;
	
	@Override
	public Iterable<Pelicula> findAll() {
		// TODO Auto-generated method stub
		return peliculaRepository.findAll();
	}

	@Override
	public Optional<Pelicula> findById(Integer id) {
		
		// TODO Auto-generated method stub
		return peliculaRepository.findById(id);
	}
	
	@Override
	public void deleteById(Integer id) {
		// TODO Auto-generated method stub 
		peliculaRepository.deleteById(id);
	}
	
	
	public Boolean delete(Integer id) {
		// TODO Auto-generated method stub 
		peliculaRepository.deleteIntermediaNative(id); //java.sql.SQLException: Statement.executeQuery() cannot issue statements that do not produce result sets.
		return peliculaRepository.deletePeliculaNative(id);
	}
	
	@Transactional
	public Pelicula update(Pelicula peli) {
		Optional<Pelicula> peliculaExistente = peliculaRepository.findById(peli.getId());
		if(peliculaExistente.isPresent()) {
			for (Categoria c : peliculaExistente.get().getCategorias()) {
				c.getPeliculas().remove(peliculaExistente);
			}
			peliculaExistente.get().getCategorias().clear();
			
			for (Categoria c: peli.getCategorias()) {
				c.getPeliculas().add(peli);
				peli.getCategorias().add(c);
			}
		}
		
		Optional<Pelicula> findById = peliculaRepository.findById(peli.getId());
		Pelicula peliculaModificada = findById.get();
		return peli;
		
	}
	

	@Override
	@Transactional
	public Pelicula save(Pelicula peli) {
		
		try {
			Optional<Pelicula> pelicula = peliculaRepository.findById(peli.getId());
			if(pelicula == null) {
				peliculaRepository.save(peli);
				
			}
			
		}catch(Exception ex) {
			System.out.println("No se pudo guardar");
		}
		return null;
	}
	
	

	
	

	

}
