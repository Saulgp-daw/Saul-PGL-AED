package es.iespuertodelacruz.sgp.instituto.controller;

import java.util.ArrayList;
import java.util.List;
import java.util.stream.Collectors;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import es.iespuertodelacruz.sgp.instituto.dto.ModificarDTO;
import es.iespuertodelacruz.sgp.instituto.dto.RegisterDTO;
import es.iespuertodelacruz.sgp.instituto.dto.UsuarioDTO;
import es.iespuertodelacruz.sgp.instituto.entities.Usuario;
import es.iespuertodelacruz.sgp.instituto.security.AuthService;
import es.iespuertodelacruz.sgp.instituto.service.UsuarioService;

@RestController
@CrossOrigin
@RequestMapping("/api/v2/usuarios")
public class UsuarioControllerV2 {

	@Autowired
	private UsuarioService usuarioService;
	
	@Autowired
	private AuthService service;
	
	@GetMapping("")
	public ResponseEntity<?> findAll(){
		Iterable<Usuario> iterable = usuarioService.findAll();
		List<Usuario> lista = new ArrayList<Usuario>();
		
		for(Usuario u : iterable) {
			lista.add(u);
		}
		
		
		return ResponseEntity.ok(lista.stream().map(this::convertirAdto).collect(Collectors.toList()));
	}
	
	@PutMapping("/{username}")
	public ResponseEntity<?> update(@PathVariable String username, @RequestBody ModificarDTO request){
		
		Usuario usuarioEncontrado = usuarioService.findByName(username);
		
		if(usuarioEncontrado != null) {
			Boolean valida = service.passCoinciden(request.getPasswordAntigua(), usuarioEncontrado.getPassword());
			if(valida) {
				usuarioEncontrado.setEmail(request.getEmail());
				
				String passCodificada = service.codificarPassword(request.getPassword());
				usuarioEncontrado.setPassword(passCodificada);
				usuarioEncontrado.setHash(service.generateNewToken(usuarioEncontrado.getEmail(), passCodificada));
				
				Usuario update = usuarioService.update(usuarioEncontrado);
				
				
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
