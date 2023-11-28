package es.iespuertodelacruz.jm.prueba2.controller;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import es.iespuertodelacruz.jm.prueba2.entity.Persona;
import es.iespuertodelacruz.jm.prueba2.repository.IPersonaRepository;

@RestController
@CrossOrigin
@RequestMapping("/api/personas")
public class PruebaController {
	
	@Autowired 
	private IPersonaRepository personaRepository;
	
	@GetMapping("/getAll")
	public ResponseEntity<?> misPruebas(){
		List<Persona> lista = personaRepository.findAll();
		return ResponseEntity.ok(lista);
	}
	
}
