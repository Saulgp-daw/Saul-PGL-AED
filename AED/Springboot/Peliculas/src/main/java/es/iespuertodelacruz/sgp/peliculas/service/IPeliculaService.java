package es.iespuertodelacruz.sgp.peliculas.service;

import java.util.List;
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
	
	@Transactional
	public void deleteByIdNative(Integer id) {
		peliculaRepository.deleteIntermediaNative(id);
		peliculaRepository.deletePeliculaNative(id);	
	}
	
	@Override
	@Transactional
	public void deleteById(Integer id) {
		
		Optional<Pelicula> opt = peliculaRepository.findById(id);
		if(!opt.isPresent()) {
			return;
		}
		
		Pelicula pelicula = opt.get();
		List<Categoria> cats = pelicula.getCategorias();
		if( cats != null) {
			for( Categoria c : cats) {
				c.getPeliculas().remove(pelicula);
			}
			cats.clear();
		}
		peliculaRepository.delete(pelicula);
	}
	
	/*
	public Boolean delete(Integer id) {
		// TODO Auto-generated method stub 
		peliculaRepository.deleteIntermediaNative(id); //java.sql.SQLException: Statement.executeQuery() cannot issue statements that do not produce result sets.
		return peliculaRepository.deletePeliculaNative(id);
	}*/
	
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
		Pelicula peliGuardada = null;
		try {
			//Encuentro la película
			//Optional<Pelicula> pelicula = peliculaRepository.findById(peli.getId());
			//La guardo independientemente de que tenga o no categorias para así poder persistir en la bbdd si necesita cambios
			peliGuardada = peliculaRepository.save(peli);
			//guardo en mi peli guardada las categorias de la que se pasa por parámetro
			peliGuardada.setCategorias(peli.getCategorias());
			//recorro todas las categorias de la peli guardada y a esa tabla le añado la pelicula que tengo
			for(Categoria c : peliGuardada.getCategorias()) {
				c.getPeliculas().add(peliGuardada);
			}
			
		}catch(Exception ex) {
			System.out.println("No se pudo guardar");
		}
		return peliGuardada;
	}
	
	

	
	

	

}
