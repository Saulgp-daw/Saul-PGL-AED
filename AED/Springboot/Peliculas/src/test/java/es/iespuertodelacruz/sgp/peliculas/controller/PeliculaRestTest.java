package es.iespuertodelacruz.sgp.peliculas.controller;

//import is()
import static org.hamcrest.CoreMatchers.is;
//import hasSize()
import static org.hamcrest.Matchers.hasSize;


import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.autoconfigure.web.servlet.WebMvcTest;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.boot.test.mock.mockito.MockBean;
import org.springframework.context.annotation.Import;
import org.springframework.http.MediaType;
import org.springframework.test.context.ActiveProfiles;
import org.springframework.test.context.jdbc.Sql;
import org.springframework.test.web.servlet.MockMvc;
import org.springframework.test.web.servlet.request.MockMvcRequestBuilders;

import com.fasterxml.jackson.databind.ObjectMapper;

import static org.mockito.Mockito.when;
import static org.springframework.test.web.servlet.result.MockMvcResultMatchers.jsonPath;
import static org.springframework.test.web.servlet.result.MockMvcResultMatchers.status;

import java.util.List;

import org.junit.jupiter.api.Test;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.autoconfigure.web.servlet.WebMvcTest;
import org.springframework.boot.test.mock.mockito.MockBean;
import org.springframework.context.annotation.Import;
import org.springframework.test.context.ActiveProfiles;
import org.springframework.test.web.servlet.MockMvc;
import org.springframework.test.web.servlet.request.MockMvcRequestBuilders;

import com.fasterxml.jackson.databind.ObjectMapper;

import es.iespuertodelacruz.sgp.peliculas.config.ApplicationNoSecurity;
import es.iespuertodelacruz.sgp.peliculas.entities.Pelicula;
import es.iespuertodelacruz.sgp.peliculas.service.FileStorageService;
import es.iespuertodelacruz.sgp.peliculas.service.PeliculaService;

@ActiveProfiles("test")
@WebMvcTest(PeliculaController.class)
@Import(ApplicationNoSecurity.class)
public class PeliculaRestTest {

	@Autowired
	MockMvc mockMvc;

	@Autowired
	ObjectMapper mapper;

	
	@MockBean
	PeliculaService peliculaService;

	@MockBean
	FileStorageService fileStorageService;

	@Test
	public void findAllTest() throws Exception {
		
		Pelicula p1 = new Pelicula(); p1.setId(1); p1.setTitulo("uno");
		Pelicula p2 = new Pelicula(); p2.setId(1); p2.setTitulo("dos");
		List<Pelicula> peliculas = List.of( p1,p2 );
	
		when(peliculaService.findAll()).thenReturn(peliculas);
    
        mockMvc.perform(
    			MockMvcRequestBuilders
    				.get("/api/peliculas")

    				.contentType(MediaType.APPLICATION_JSON)
                    
    				
    		)
    		.andExpect(status().isOk())
    		.andExpect(jsonPath("$",hasSize(2)))
    		.andExpect(jsonPath("$[1].titulo", is("dos")));
    		;
    		
    		
	}

}

