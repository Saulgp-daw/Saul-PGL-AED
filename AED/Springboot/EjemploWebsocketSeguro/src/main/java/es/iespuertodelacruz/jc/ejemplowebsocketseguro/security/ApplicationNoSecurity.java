package es.iespuertodelacruz.jc.ejemplowebsocketseguro.security;

import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.http.HttpMethod;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.config.annotation.web.configuration.WebSecurityCustomizer;
import org.springframework.security.config.annotation.web.configurers.AbstractHttpConfigurer;
import org.springframework.security.config.http.SessionCreationPolicy;
import org.springframework.security.web.SecurityFilterChain;
import org.springframework.security.web.authentication.UsernamePasswordAuthenticationFilter;
import org.springframework.security.web.util.matcher.AntPathRequestMatcher;

//@Configuration
public class ApplicationNoSecurity {

	@Bean
	public WebSecurityCustomizer webSecurityCustomizer() {

		return (web) -> web.ignoring()
				//.anyRequest()
				.requestMatchers(new AntPathRequestMatcher("/**"))
				//.requestMatchers(new AntPathRequestMatcher("/h2-console/**"))
				//.requestMatchers(new AntPathRequestMatcher("/api/**"))
	

		;
	}
}