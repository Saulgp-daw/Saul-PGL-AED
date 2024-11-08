package es.iespuertodelacruz.jm.prueba2.controller;

import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import es.iespuertodelacruz.jm.prueba2.entity.Persona;
import es.iespuertodelacruz.jm.prueba2.repository.IPersonaRepository;

@RestController
@CrossOrigin
@RequestMapping("/personas")
public class PruebaController {
	
	@Autowired 
	private IPersonaRepository personaRepository;
	
	@GetMapping("/getAll")
	public ResponseEntity<?> findAll(){
		List<Persona> lista = personaRepository.findAll();
		return ResponseEntity.ok(lista);
	}
	
	@GetMapping("/findById")
	public ResponseEntity<?> findById(@RequestParam Integer id){
		Optional<Persona> persona = personaRepository.findById(id);
		return ResponseEntity.ok(persona);
	}
	
	@GetMapping("/findByName")
	public ResponseEntity<?> findByName(@RequestParam String name){
		List<Persona> personas = personaRepository.findByName("%"+name+"%");
		return ResponseEntity.ok(personas);
	}
	
	@GetMapping("/deleteById")
	public ResponseEntity<?> deleteById(@RequestParam Integer id){
		personaRepository.deleteById(id);
		return ResponseEntity.ok("Ok");
	}
	
	@GetMapping("/save")
	public ResponseEntity<?> save(@RequestParam String nombre, @RequestParam Integer edad){
		Persona p = new Persona();
		p.setEdad(edad);
		p.setNombre(nombre);
		Persona persona = personaRepository.save(p);
		return ResponseEntity.ok(persona);
	}
	
	
	
}
