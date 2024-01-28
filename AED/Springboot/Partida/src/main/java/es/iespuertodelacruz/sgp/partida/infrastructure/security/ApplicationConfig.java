package es.iespuertodelacruz.sgp.partida.infrastructure.security;



import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.security.authentication.AuthenticationManager;
import org.springframework.security.authentication.AuthenticationProvider;
import org.springframework.security.authentication.dao.DaoAuthenticationProvider;
import org.springframework.security.config.annotation.authentication.configuration.AuthenticationConfiguration;
import org.springframework.security.core.userdetails.UserDetailsService;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;
import org.springframework.security.crypto.password.PasswordEncoder;

import es.iespuertodelacruz.sgp.partida.infrastructure.adapter.secondary.UsuarioDocument;
import es.iespuertodelacruz.sgp.partida.infrastructure.adapter.secondary.UsuarioDocumentService;




@Configuration
public class ApplicationConfig {
	
	@Autowired
	private  UsuarioDocumentService service;


	@Bean
	public UserDetailsService userDetailsService() {
		return username -> {
			
		
			UsuarioDocument usuario = service.findByName(username);
			UserDetailsLogin user = new UserDetailsLogin();
		    user.setUsername(usuario.getNombre());
		    user.setPassword(usuario.getPassword());
		    user.setRole(usuario.getRol());
			return user;
			
		};
	}

	@Bean
	public AuthenticationProvider authenticationProvider() {
		DaoAuthenticationProvider authProvider = new DaoAuthenticationProvider();
		authProvider.setUserDetailsService(userDetailsService());
		authProvider.setPasswordEncoder(passwordEncoder());
		return authProvider;
	}

	@Bean
	public AuthenticationManager authenticationManager(AuthenticationConfiguration config) throws Exception {
		return config.getAuthenticationManager();
	}

	@Bean
	public PasswordEncoder passwordEncoder() {
		return new BCryptPasswordEncoder();
	}
}
