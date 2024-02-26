package es.iespuertodelacruz.jc.websocketpiedrapapeltijera.config;



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

import es.iespuertodelacruz.jc.websocketpiedrapapeltijera.entity.UsuarioEntity;
import es.iespuertodelacruz.jc.websocketpiedrapapeltijera.security.UserDetailsLogin;
import es.iespuertodelacruz.jc.websocketpiedrapapeltijera.service.UsuarioEntityService;



@Configuration
public class ApplicationConfig {
	
	@Autowired
	private  UsuarioEntityService service;


	@Bean
	public UserDetailsService userDetailsService() {
		return username -> {
			
		
			UsuarioEntity usuario = service.findByName(username);
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
