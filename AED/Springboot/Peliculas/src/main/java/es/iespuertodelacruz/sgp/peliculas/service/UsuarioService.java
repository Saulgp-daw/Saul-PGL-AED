package es.iespuertodelacruz.sgp.peliculas.service;

import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import es.iespuertodelacruz.sgp.peliculas.entities.Usuario;
import es.iespuertodelacruz.sgp.peliculas.repository.UsuarioRepository;

@Service
public class UsuarioService implements IGenericService<Usuario, Integer> {
	@Autowired
	UsuarioRepository usuariorepository;

	@Override
	public Iterable<Usuario> findAll() {
		return usuariorepository.findAll();
	}

	@Override
	public Optional<Usuario> findById(Integer id) {
		return usuariorepository.findById(id);
	}

	@Override
	public Usuario save(Usuario element) {
		return usuariorepository.save(element);
	}

	@Override
	public void deleteById(Integer id) {
		usuariorepository.deleteById(id);
	}

	public Usuario findByName(String nombre) {
		return usuariorepository.findByName(nombre);
	}
	
	public Usuario findByEmail(String email) {
		return usuariorepository.findByEmail(email);
	}
}
