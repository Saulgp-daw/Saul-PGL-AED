package es.iespuertodelacruz.sgp.peliculas.controller;

import java.util.logging.Logger;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import es.iespuertodelacruz.sgp.peliculas.dto.LoginDTO;
import es.iespuertodelacruz.sgp.peliculas.dto.RegisterDTO;
import es.iespuertodelacruz.sgp.peliculas.entities.Usuario;
import es.iespuertodelacruz.sgp.peliculas.security.AuthService;
import es.iespuertodelacruz.sgp.peliculas.service.MailService;
import es.iespuertodelacruz.sgp.peliculas.service.UsuarioService;

@RestController
@CrossOrigin
@RequestMapping("/api")
public class LoginController {
	Logger log;
	@Autowired
	private AuthService service;
	@Autowired
	private MailService mailService;
	@Autowired
	private UsuarioService usuarioService;

	@PostMapping("/register")
	public ResponseEntity<?> register(@RequestBody RegisterDTO request) {
		String token = service.register(request);
		mailService.send(request.getEmail(), "Verficiación de cuenta",
				"http://localhost:8080/api/registerverify?usermail=" + request.getEmail() + "&hash="
						+ token);
		return ResponseEntity.ok(token);
	}

	@PostMapping("/login")
	public ResponseEntity<String> authenticate(@RequestBody LoginDTO request) {
		String token = service.authenticate(request);
		if (token == null)
			return ResponseEntity.status(HttpStatus.FORBIDDEN).body("User/pass erróneo");
		else
			return ResponseEntity.ok(token);
	}

	@GetMapping("/registerverify")
	public ResponseEntity<?> registerVerify(@RequestParam(name = "usermail") String usermail,
			@RequestParam(name = "hash") String hash) {
		Usuario encontrado = null;
		encontrado = usuarioService.findByEmail(usermail);
		log = Logger.getLogger("debug");
		

		if (encontrado != null) {
			log.info(encontrado.getHash() );
			log.info(hash);
			if (hash.equals(encontrado.getHash())) {
				
				encontrado.setActive((byte) 1);
				Usuario guardado = usuarioService.save(encontrado);
				if (guardado != null) {
					return ResponseEntity.ok(guardado);
				}
			}

		}

		return ResponseEntity.badRequest().body("Usuario inexistente");

	}
}
