package es.iespuertodelacruz.jc.graphqlfirstapp.security;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;




@Service
public class LoginService {
	


	@Autowired
	private PasswordEncoder passwordEncoder;

	@Autowired
	private JwtService jwtService;



	public String authenticate(UserDetailsLogin request) {
		Usuario usuario = new Usuario();
		usuario.setNombre(request.getUsername());
		usuario.setPassword(request.getPassword());
		if(usuario.getNombre().equals("root"))
			usuario.setRol("ROLE_ADMIN");
		else
			usuario.setRol("ROLE_USER");

		UserDetailsLogin userlogin = null;
		
		String generateToken = null;
		
		generateToken = jwtService.generateToken(usuario.getNombre(), usuario.getRol());
		
		return generateToken;
	}
}

