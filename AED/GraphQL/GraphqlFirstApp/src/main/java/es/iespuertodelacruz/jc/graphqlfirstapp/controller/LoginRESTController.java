package es.iespuertodelacruz.jc.graphqlfirstapp.controller;

import java.util.logging.Logger;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import es.iespuertodelacruz.jc.graphqlfirstapp.security.LoginService;
import es.iespuertodelacruz.jc.graphqlfirstapp.security.UserDetailsLogin;



class UserDTO{
	String nombre;
	String password;
	public String getNombre() {
		return nombre;
	}
	public void setNombre(String nombre) {
		this.nombre = nombre;
	}
	public String getPassword() {
		return password;
	}
	public void setPassword(String password) {
		this.password = password;
	}
	public UserDTO() {}
}

@RestController
@CrossOrigin
@RequestMapping("/api")
public class LoginRESTController {

	Logger log;

	@Autowired
	private LoginService service;

	
	
	


	@PostMapping("/login")
	public ResponseEntity<String> authenticate(@RequestBody UserDTO request) {
		UserDetailsLogin udl = new UserDetailsLogin();
		udl.setUsername(request.getNombre());
		udl.setPassword(request.getPassword());
		
		String token = service.authenticate(udl);
		if (token == null)
			return ResponseEntity.status(HttpStatus.FORBIDDEN).body("User/pass erróneo");
		else
			return ResponseEntity.ok(token);
	}

}