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

import es.iespuertodelacruz.sgp.peliculas.dto.RegisterDTO;
import es.iespuertodelacruz.sgp.peliculas.security.AuthService;
import es.iespuertodelacruz.sgp.peliculas.security.UserDetailsLogin;

@RestController
@CrossOrigin
@RequestMapping("/api")
public class LoginController {
	Logger log;
	@Autowired
	private AuthService service;

	@PostMapping("/register")
	public ResponseEntity<?> register(@RequestBody RegisterDTO request) {
		return ResponseEntity.ok(service.register(request));
	}

	@PostMapping("/login")
	public ResponseEntity<String> authenticate(
			@RequestBody UserDetailsLogin request
	) {
	String token = service.authenticate(request);
	if(token == null)
		return ResponseEntity.status(HttpStatus.FORBIDDEN).body("User/pass erróneo");
	else
		return ResponseEntity.ok(token);
	}
	
	@GetMapping("/registerverify")
	public ResponseEntity<?> registerVerify(
			@RequestParam(name = "usermail") String usermail,
	        @RequestParam(name = "hash") String hash){
			
		
				return null;
		
	}
}
