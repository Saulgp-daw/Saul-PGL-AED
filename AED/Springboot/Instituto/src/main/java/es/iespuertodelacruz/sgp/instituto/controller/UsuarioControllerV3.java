package es.iespuertodelacruz.sgp.instituto.controller;

import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import es.iespuertodelacruz.sgp.instituto.dto.ModificarDTO;
import es.iespuertodelacruz.sgp.instituto.dto.UsuarioDTO;
import es.iespuertodelacruz.sgp.instituto.entities.Usuario;
import es.iespuertodelacruz.sgp.instituto.security.AuthService;
import es.iespuertodelacruz.sgp.instituto.service.UsuarioService;

@RestController
@CrossOrigin
@RequestMapping("/api/v3/usuarios")
public class UsuarioControllerV3 {

	@Autowired
	private UsuarioService usuarioService;
	
	@Autowired
	private AuthService service;
	
	@GetMapping("")
	public ResponseEntity<?> findAll(){
		Iterable<Usuario> iterable = usuarioService.findAll();		
		return ResponseEntity.ok(iterable);
	}
	
	@PostMapping("")
	public ResponseEntity<?> save(@RequestBody Usuario usuario){
		/**
		 * Hacer el DTO de usuarioPOST 
		 * ponerle la contraseña codificada
		 * poner el hash
		 * poner el active a 1
		 */
		Usuario save = usuarioService.save(usuario);
		return ResponseEntity.ok(save);
	}
	
	@PutMapping("/{id}")
	public ResponseEntity<?> update(@PathVariable Integer id, @RequestBody ModificarDTO request){
		
		Optional<Usuario> usuarioEncontrado = usuarioService.findById(id);
		
		if(usuarioEncontrado.isPresent()) {
			Boolean valida = service.passCoinciden(request.getPasswordAntigua(), usuarioEncontrado.get().getPassword());
			if(valida) {
				usuarioEncontrado.get().setEmail(request.getEmail());
				
				String passCodificada = service.codificarPassword(request.getPassword());
				usuarioEncontrado.get().setPassword(passCodificada);
				usuarioEncontrado.get().setHash(service.generateNewToken(usuarioEncontrado.get().getEmail(), passCodificada));
				
				Usuario update = usuarioService.update(usuarioEncontrado.get());
				
				
				return ResponseEntity.ok(update);
			}
			return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("No puedes modificar a otros");
		}
		
		
		
		return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("No existe este usuario");
		
		
	}
	
	private UsuarioDTO convertirAdto(Usuario usuario) {
		return  new UsuarioDTO(usuario.getEmail());
	}
	
}
