package es.iespuertodelacruz.jc.websocketpiedrapapeltijera.security;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.http.HttpMethod;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.config.annotation.web.configuration.EnableWebSecurity;
import org.springframework.security.config.annotation.web.configurers.AbstractHttpConfigurer;
import org.springframework.security.config.annotation.web.configurers.HeadersConfigurer;
import org.springframework.security.config.http.SessionCreationPolicy;
import org.springframework.security.web.SecurityFilterChain;
import org.springframework.security.web.authentication.UsernamePasswordAuthenticationFilter;

@Configuration
@EnableWebSecurity
public class SecurityConfiguration {

	@Autowired	private JwtFilter jwtAuthFilter;

	@Bean
	public SecurityFilterChain securityFilterChain(HttpSecurity http) throws Exception {

		http
			.cors(cors->cors.disable())
			.csrf(csrf -> csrf.disable()	)
				.authorizeHttpRequests(auth -> auth
					.requestMatchers(HttpMethod.OPTIONS, "/**").permitAll()
					.requestMatchers(
					"/", "/swagger-ui.html", 
					"/swagger-ui/**", "/v2/**", 
					"configuration/**",	"/swagger*/**", 
					"/webjars/**", "/api/login", 
					"/api/register", "/v3/**",
					"/websocket*/**", "/sockjs*/**", 
					"/index.html", "/application.js", "application.css",
					"/api/v1/**", "/h2-console/**"
					).permitAll()
					
		            	
					.requestMatchers("/api/v3/**").hasRole("ADMIN").anyRequest().authenticated()
				)
		
                .headers(httpSecurityHeadersConfigurer -> 
                	httpSecurityHeadersConfigurer
                	.frameOptions(HeadersConfigurer.FrameOptionsConfig::disable)
                )
				.sessionManagement(sess -> sess.sessionCreationPolicy(SessionCreationPolicy.STATELESS))
				.addFilterBefore(jwtAuthFilter, UsernamePasswordAuthenticationFilter.class);

		
		return http.getOrBuild();
	}
}