package es.iespuertodelacruz.sgp.partida.infrastructure.security;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;

import es.iespuertodelacruz.sgp.partida.infrastructure.adapter.secondary.UsuarioDocument;
import es.iespuertodelacruz.sgp.partida.infrastructure.adapter.secondary.UsuarioDocumentService;




@Service
public class LoginService {
	
	@Autowired
	private UsuarioDocumentService usuarioservice;

	@Autowired
	private PasswordEncoder passwordEncoder;

	@Autowired
	private JwtService jwtService;

	public String register(UserDetailsLogin userdetails) {
		
		
		UsuarioDocument usuario = new UsuarioDocument();
		usuario.setNombre(userdetails.getUsername());
		usuario.setPassword(passwordEncoder.encode(userdetails.getPassword()));
		usuario.setRol("ROLE_USER");
		
		usuario = usuarioservice.save(usuario);
		
		userdetails.setRole(usuario.getRol());
		String generateToken = jwtService.generateToken(userdetails.username, userdetails.password);
		return generateToken;
	}

	public String authenticate(UserDetailsLogin request) {
		
		
		UsuarioDocument usuario = usuarioservice.findByName(request.getUsername());

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

