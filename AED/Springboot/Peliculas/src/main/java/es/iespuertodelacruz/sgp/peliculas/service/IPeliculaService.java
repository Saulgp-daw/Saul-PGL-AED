package es.iespuertodelacruz.sgp.peliculas.service;

import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

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
	@Transactional
	public Pelicula save(Pelicula peli) {
		
		try {
			Optional<Pelicula> pelicula = peliculaRepository.findById(peli.getId());
			
		}catch(Exception ex) {
			throw 
		}
		
		
		
		
		return null;
	}

	@Override
	public void deleteById(Integer id) {
		// TODO Auto-generated method stub
		
	}

	

}
