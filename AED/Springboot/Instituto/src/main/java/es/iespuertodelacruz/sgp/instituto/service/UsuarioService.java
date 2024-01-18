package es.iespuertodelacruz.sgp.instituto.service;

import static org.springframework.test.web.servlet.result.MockMvcResultMatchers.request;

import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import es.iespuertodelacruz.sgp.instituto.entities.Usuario;
import es.iespuertodelacruz.sgp.instituto.repository.UsuarioRepository;
import jakarta.transaction.Transactional;

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
	
	@Transactional
	public Usuario update(Usuario usuario) {
		Optional<Usuario> usuarioAntiguo = usuariorepository.findById(usuario.getId());
		
		if(usuarioAntiguo.isPresent()) {
			usuarioAntiguo.get().setEmail(usuario.getEmail());
			usuarioAntiguo.get().setPassword(usuario.getPassword());
			usuarioAntiguo.get().setHash(usuario.getHash());
			return usuarioAntiguo.get();
		}
		return null;
	}
}
