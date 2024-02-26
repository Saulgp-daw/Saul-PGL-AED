package es.iespuertodelacruz.jc.websocketpiedrapapeltijera.security;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;


import es.iespuertodelacruz.jc.websocketpiedrapapeltijera.entity.UsuarioEntity;
import es.iespuertodelacruz.jc.websocketpiedrapapeltijera.service.UsuarioEntityService;



@Service
public class LoginService {
	
	@Autowired
	private UsuarioEntityService usuarioservice;

	@Autowired
	private PasswordEncoder passwordEncoder;

	@Autowired
	private JwtService jwtService;

	public String register(UserDetailsLogin userdetails) {
		UsuarioEntity usuario = new UsuarioEntity();
		usuario.setNombre(userdetails.getUsername());
		usuario.setPassword(passwordEncoder.encode(userdetails.getPassword()));
		usuario.setRol("ROLE_USER");
		
		usuario = usuarioservice.save(usuario);
		
		userdetails.setRole(usuario.getRol());
		String generateToken = jwtService.generateToken(userdetails.username, userdetails.password);
		return generateToken;
	}

	public String authenticate(UserDetailsLogin request) {
		UsuarioEntity usuario = usuarioservice.findByName(request.getUsername());

		UserDetailsLogin userlogin = null;
		if (usuario != null) {
			if (passwordEncoder.matches(request.getPassword(), usuario.getPassword())) {
				userlogin = new UserDetailsLogin();
				userlogin.setUsername(usuario.getNombre());
				userlogin.setPassword(usuario.getPassword());
				userlogin.setRole(usuario.getRol());
			}
		}
		String generateToken = null;
		if (userlogin != null) {
			generateToken = jwtService.generateToken(usuario.getNombre(), usuario.getRol());
		}
		return generateToken;
	}
}

