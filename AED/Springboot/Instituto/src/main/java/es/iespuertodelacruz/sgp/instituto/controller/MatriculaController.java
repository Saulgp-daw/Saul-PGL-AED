package es.iespuertodelacruz.sgp.instituto.controller;

import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import es.iespuertodelacruz.sgp.instituto.dto.MatriculaDTO;
import es.iespuertodelacruz.sgp.instituto.entities.Alumno;
import es.iespuertodelacruz.sgp.instituto.entities.Matricula;
import es.iespuertodelacruz.sgp.instituto.service.AlumnoService;
import es.iespuertodelacruz.sgp.instituto.service.FileStorageService;
import es.iespuertodelacruz.sgp.instituto.service.MatriculaService;

@RestController
@CrossOrigin
@RequestMapping("/api/v1/matriculas")
public class MatriculaController {

	@Autowired
	private MatriculaService matriculaService;
	
	@Autowired
	private AlumnoService alumnoService;
	
	@Autowired
	private FileStorageService storageService;
	
	@GetMapping("")
	public ResponseEntity<?> findAll(){
		Iterable<Matricula> lista = matriculaService.findAll();
		return ResponseEntity.ok(lista);
	}
	
	@GetMapping("/{id}")
	public ResponseEntity<?> findByDni(@PathVariable Integer id){
		Optional<Matricula> element = matriculaService.findById(id);
		return ResponseEntity.ok(element);
	}
	
	
	
	
 }
