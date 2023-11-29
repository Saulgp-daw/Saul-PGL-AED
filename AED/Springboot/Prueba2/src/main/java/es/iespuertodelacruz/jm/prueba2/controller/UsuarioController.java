package es.iespuertodelacruz.jm.prueba2.controller;

import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import es.iespuertodelacruz.jm.prueba2.entity.Usuario;
import es.iespuertodelacruz.jm.prueba2.repository.IUsuarioRepository;

@RestController
@CrossOrigin
@RequestMapping("/usuarios")
public class UsuarioController {
	@Autowired 
	private IUsuarioRepository usuarioRepository;
	
	@GetMapping("/getAll")
	public ResponseEntity<?> findAll(){
		List<Usuario> lista = usuarioRepository.findAll();
		return ResponseEntity.ok(lista);
	}
	
	@GetMapping("/findById")
	public ResponseEntity<?> findById(@RequestParam Integer id){
		Optional<Usuario> usuario = usuarioRepository.findById(id);
		return ResponseEntity.ok(usuario);
	}
	
	@GetMapping("/findByName")
	public ResponseEntity<?> findByName(@RequestParam String name){
		List<Usuario> usuarios = usuarioRepository.findByName("%"+name+"%");
		return ResponseEntity.ok(usuarios);
	}
	
	@GetMapping("/deleteById")
	public ResponseEntity<?> deleteById(@RequestParam Integer id){
		usuarioRepository.deleteById(id);
		return ResponseEntity.ok("Ok");
	}
	
	@GetMapping("/save")
	public ResponseEntity<?> save(@RequestParam String nombre, @RequestParam String password, @RequestParam String rol){
		Usuario u = new Usuario();
		u.setNombre(nombre);
		u.setPassword(password);
		u.setRol(rol);
		Usuario usuario = usuarioRepository.save(u);
		return ResponseEntity.ok(usuario);
	}
}
