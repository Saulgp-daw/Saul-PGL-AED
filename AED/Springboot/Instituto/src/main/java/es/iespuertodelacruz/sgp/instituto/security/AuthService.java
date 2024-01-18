package es.iespuertodelacruz.sgp.instituto.security;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;

import es.iespuertodelacruz.sgp.instituto.dto.LoginDTO;
import es.iespuertodelacruz.sgp.instituto.dto.RegisterDTO;
import es.iespuertodelacruz.sgp.instituto.entities.Usuario;
import es.iespuertodelacruz.sgp.instituto.service.UsuarioService;

@Service
public class AuthService {
	@Autowired
	private UsuarioService usuarioservice;
	@Autowired
	private PasswordEncoder passwordEncoder;
	@Autowired
	private JwtService jwtService;

	public String register(RegisterDTO userdetails) {
		Usuario userentity = new Usuario();
		userentity.setNombre(userdetails.getUsername());
		userentity.setPassword(passwordEncoder.encode(userdetails.getPassword()));
		userentity.setRol("ROLE_USER");
		
		//userdetails.setRole(userentity.getRol());
		String generateToken = jwtService.generateToken(userdetails.getUsername(), userdetails.getPassword());
		userentity.setEmail(userdetails.getEmail());
		userentity.setHash(generateToken);
		Usuario save = usuarioservice.save(userentity);
		return generateToken;
	}

	public String authenticate(LoginDTO request) {
		Usuario userentity = usuarioservice.findByName(request.getUsername());
		UserDetailsLogin userlogin = null;
		if (userentity != null) {
			if (passwordEncoder.matches(request.getPassword(), userentity.getPassword())) {
				userlogin = new UserDetailsLogin();
				userlogin.setUsername(userentity.getNombre());
				userlogin.setPassword(userentity.getPassword());
				userlogin.setRole(userentity.getRol());
			}
		}
		String generateToken = null;
		if (userlogin != null) {
			generateToken = jwtService.generateToken(userentity.getNombre(), userentity.getRol());
		}
		return generateToken;
	}
	
	public Boolean passCoinciden(String nuevaPass, String passCodificada) {
		return passwordEncoder.matches(nuevaPass, passCodificada);
	}
	
	public String codificarPassword(String password) {
		return passwordEncoder.encode(password);
	}
	
	public String generateNewToken(String username, String password) {
		return jwtService.generateToken(username, password);
	}
	
	 
}
