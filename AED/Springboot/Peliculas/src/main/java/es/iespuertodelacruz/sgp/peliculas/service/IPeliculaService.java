package es.iespuertodelacruz.sgp.peliculas.service;

import java.util.ArrayList;
import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import es.iespuertodelacruz.sgp.peliculas.entities.Categoria;
import es.iespuertodelacruz.sgp.peliculas.entities.Pelicula;
import es.iespuertodelacruz.sgp.peliculas.repository.ICategoriaRepository;
import es.iespuertodelacruz.sgp.peliculas.repository.IPeliculaRepository;
import jakarta.transaction.Transactional;

@Service
public class IPeliculaService implements IGenericService<Pelicula, Integer> {

	@Autowired
	private IPeliculaRepository peliculaRepository;
	
	@Autowired
	private ICategoriaRepository categoriaRepository;

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
		if (!opt.isPresent()) {
			return;
		}

		Pelicula pelicula = opt.get();
		List<Categoria> cats = pelicula.getCategorias();
		if (cats != null) {
			for (Categoria c : cats) {
				c.getPeliculas().remove(pelicula);
			}
			cats.clear();
		}
		peliculaRepository.delete(pelicula);
	}

	/*
	 * public Boolean delete(Integer id) { // TODO Auto-generated method stub
	 * peliculaRepository.deleteIntermediaNative(id); //java.sql.SQLException:
	 * Statement.executeQuery() cannot issue statements that do not produce result
	 * sets. return peliculaRepository.deletePeliculaNative(id); }
	 */

	@Transactional
	public Pelicula update(Pelicula peli) {
		Optional<Pelicula> peliculaExistente = peliculaRepository.findById(peli.getId());

		if (peliculaExistente.isPresent()) {
			if (peliculaExistente.get().getCategorias() != null) {
				
				List<Categoria> categoriasPeliAntigua = peliculaExistente.get().getCategorias();
				
				for (Categoria c : categoriasPeliAntigua) {
					c.getPeliculas().remove(peliculaExistente.get());
				}
				
				peliculaExistente.get().getCategorias().clear();
				
				List<Categoria> categoriasAuxiliares = new ArrayList<Categoria>();
				List<Categoria> categorias = peli.getCategorias();

				for (Categoria c : categorias) {
					categoriasAuxiliares.add(c);
				}
				
				for(Categoria c : categoriasAuxiliares) {
					if(!peliculaExistente.get().getCategorias().contains(c)) {
						Optional<Categoria> findById = categoriaRepository.findById(c.getId());
						findById.get().getPeliculas().add(peli);
						peliculaExistente.get().getCategorias().add(findById.get());
						
					}
				}

			}
			peliculaExistente.get().setTitulo(peli.getTitulo());
			peliculaExistente.get().setActores(peli.getActores());
			peliculaExistente.get().setArgumento(peli.getArgumento());
			peliculaExistente.get().setDireccion(peli.getDireccion());
			peliculaExistente.get().setImagen(peli.getImagen());
			peliculaExistente.get().setTrailer(peli.getTrailer());
			
			
		}

		// Optional<Pelicula> findById = peliculaRepository.findById(peli.getId());
		// Pelicula peliculaModificada = findById.get();
		return peliculaExistente.get();
	}

	@Override
	@Transactional
	public Pelicula save(Pelicula peli) {
		Pelicula peliGuardada = null;
		try {
			// Encuentro la película
			// La guardo independientemente de que tenga o no categorias para así poder
			// persistir en la bbdd si necesita cambios
			peliGuardada = peliculaRepository.save(peli);
			// guardo en mi peli guardada las categorias de la que se pasa por parámetro
			peliGuardada.setCategorias(peli.getCategorias());
			// recorro todas las categorias de la peli guardada y a esa tabla le añado la
			// pelicula que tengo
			for (Categoria c : peliGuardada.getCategorias()) {
				c.getPeliculas().add(peliGuardada);
			}

		} catch (Exception ex) {
			System.out.println("No se pudo guardar");
		}
		return peliGuardada;
	}

}
