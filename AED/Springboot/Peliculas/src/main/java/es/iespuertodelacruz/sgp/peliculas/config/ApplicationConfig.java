package es.iespuertodelacruz.sgp.peliculas.config;


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

import es.iespuertodelacruz.sgp.peliculas.entities.Usuario;
import es.iespuertodelacruz.sgp.peliculas.security.UserDetailsLogin;
import es.iespuertodelacruz.sgp.peliculas.service.UsuarioService;

@Configuration
public class ApplicationConfig {
	@Autowired
	private UsuarioService repository;

	@Bean
	public UserDetailsService userDetailsService() {
		return username -> {
			Usuario entity = repository.findByName(username);
			UserDetailsLogin user = new UserDetailsLogin();
			user.setUsername(entity.getNombre());
			user.setPassword(entity.getPassword());
			user.setRole(entity.getRol());
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
