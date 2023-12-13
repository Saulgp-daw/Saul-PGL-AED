package es.iespuertodelacruz.sgp.peliculas.service;

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
public class CategoriaService implements IGenericService<Categoria, Integer> {

	@Autowired
	private IPeliculaRepository peliculaRepository;

	@Autowired
	private ICategoriaRepository categoriaRepository;

	@Override
	public Iterable<Categoria> findAll() {
		return categoriaRepository.findAll();
	}

	@Override
	public Optional<Categoria> findById(Integer id) {
		return categoriaRepository.findById(id);
	}

	@Override
	public Categoria save(Categoria element) {
		return categoriaRepository.save(element);
	}

	@Override
	@Transactional
	public void deleteById(Integer id) {
		// TODO Auto-generated method stub
		Optional<Categoria> opt = categoriaRepository.findById(id);

		if (!opt.isPresent()) {
			return;
		}

		Categoria categoria = opt.get();
		List<Pelicula> peliculas = categoria.getPeliculas();
		
		if (peliculas != null) {
			for (Pelicula p : peliculas) {
				p.getCategorias().remove(categoria);
			}
			peliculas.clear();
		}
		categoriaRepository.delete(categoria);

	}

}
