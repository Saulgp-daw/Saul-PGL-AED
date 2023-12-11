package es.iespuertodelacruz.sgp.peliculas.controller;

import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import es.iespuertodelacruz.sgp.peliculas.entities.Pelicula;
import es.iespuertodelacruz.sgp.peliculas.service.IPeliculaService;

@RestController
@CrossOrigin
@RequestMapping("/api/peliculas")
public class PeliculaController {
	@Autowired
	private IPeliculaService peliculaService;
	
	@GetMapping("/getAll")
	public ResponseEntity<?> findAll(){
		Iterable<Pelicula> lista = peliculaService.findAll();
		return ResponseEntity.ok(lista);
	}
	
	@GetMapping("/pelicula/{id}")
	public ResponseEntity<?> findById(@PathVariable Integer id){
		Optional<Pelicula> peliculaEncontrada = peliculaService.findById(id);
		return ResponseEntity.ok(peliculaEncontrada);
	}
	
	@DeleteMapping("/borrar/{id}")
	public ResponseEntity<?> delete(@PathVariable Integer id){
		Optional<Pelicula> peliABorrar = peliculaService.findById(id);
		if(peliABorrar.isPresent()) {
			peliculaService.deleteById(id);
		return ResponseEntity.ok("pelicula borrada");
		}else {
		return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("el id del registro no existe");

		
		}
	}
	
	
}
