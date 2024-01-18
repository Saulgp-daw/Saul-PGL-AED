package es.iespuertodelacruz.sgp.instituto.controller;

import java.util.Base64;
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
import org.springframework.web.bind.annotation.RestController;

import es.iespuertodelacruz.sgp.instituto.dto.AlumnoDTO;
import es.iespuertodelacruz.sgp.instituto.entities.Alumno;
import es.iespuertodelacruz.sgp.instituto.service.AlumnoService;
import es.iespuertodelacruz.sgp.instituto.service.FileStorageService;

@RestController
@CrossOrigin
@RequestMapping("/api/v1/alumnos")
public class AlumnoController {

	@Autowired
	private AlumnoService alumnoService;
	
	@Autowired
	private FileStorageService storageService;
	
	@GetMapping("")
	public ResponseEntity<?> findAll(){
		Iterable<Alumno> lista = alumnoService.findAll();
		return ResponseEntity.ok(lista);
	}
	
	@GetMapping("/{dni}")
	public ResponseEntity<?> findByDni(@PathVariable String dni){
		Optional<Alumno> alumno = alumnoService.findById(dni);
		return ResponseEntity.ok(alumno);
	}
	
	
 }
