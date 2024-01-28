package es.iespuertodelacruz.jc.graphqlfirstapp.config;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.http.HttpMethod;
import org.springframework.security.config.annotation.method.configuration.EnableMethodSecurity;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.config.annotation.web.configuration.EnableWebSecurity;
import org.springframework.security.config.http.SessionCreationPolicy;
import org.springframework.security.web.SecurityFilterChain;
import org.springframework.security.web.authentication.UsernamePasswordAuthenticationFilter;

import es.iespuertodelacruz.jc.graphqlfirstapp.security.JwtFilter;


@Configuration
@EnableWebSecurity
@EnableMethodSecurity
public class SecurityConfiguration {

	@Autowired	private JwtFilter jwtAuthFilter;

	@Bean
	public SecurityFilterChain securityFilterChain(HttpSecurity http) throws Exception {

		http
			.cors(cors->cors.disable())
			.csrf(csrf -> csrf.disable() )
				.authorizeHttpRequests(auth -> auth
					.requestMatchers(HttpMethod.OPTIONS, "/**").permitAll()
					.requestMatchers(
					"/", "/swagger-ui.html", 
					"/swagger-ui/**", "/v2/**", 
					"configuration/**",	"/swagger*/**", 
					"/webjars/**", "/api/login", 
					"/api/register", "/v3/**",
					"/websocket*/**", "/index.html", "/api/v1/**",
					"/graphql", "/graphiql"
					).permitAll()
						
					.requestMatchers("/api/v3/**").hasRole("ADMIN").anyRequest().authenticated()
				)
				.sessionManagement(sess -> sess.sessionCreationPolicy(SessionCreationPolicy.STATELESS))
				.addFilterBefore(jwtAuthFilter, UsernamePasswordAuthenticationFilter.class);

		return http.getOrBuild();
	}
}