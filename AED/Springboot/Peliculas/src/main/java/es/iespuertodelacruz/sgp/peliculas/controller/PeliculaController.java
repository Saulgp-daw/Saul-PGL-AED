package es.iespuertodelacruz.sgp.peliculas.controller;

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

import es.iespuertodelacruz.sgp.peliculas.entities.Pelicula;
import es.iespuertodelacruz.sgp.peliculas.service.PeliculaService;

@RestController
@CrossOrigin
@RequestMapping("/api/peliculas")
public class PeliculaController {
	@Autowired
	private PeliculaService peliculaService;
	
	@GetMapping("")
	public ResponseEntity<?> findAll(){
		Iterable<Pelicula> lista = peliculaService.findAll();
		return ResponseEntity.ok(lista);
	}
	
	@GetMapping("/{id}")
	public ResponseEntity<?> findById(@PathVariable Integer id){
		Optional<Pelicula> peliculaEncontrada = peliculaService.findById(id);
		return ResponseEntity.ok(peliculaEncontrada);
	}
	
	@DeleteMapping("/{id}")
	public ResponseEntity<?> delete(@PathVariable Integer id){
		Optional<Pelicula> peliABorrar = peliculaService.findById(id);
		if(peliABorrar.isPresent()) {
			peliculaService.deleteById(id);
			return ResponseEntity.ok("pelicula borrada");
		}else {
			return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("el id del registro no existe");
		}
	}
	
	@PostMapping("")
	public ResponseEntity<?> save(@RequestBody Pelicula pelicula){
		
		Pelicula save = peliculaService.save(pelicula);
		if(save != null) {
			return ResponseEntity.ok(save);
		}
		
		return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("Error al guardar la película");
	}
	
	@PutMapping("")
	public ResponseEntity<?> update(@RequestBody Pelicula pelicula){
		Pelicula update = peliculaService.update(pelicula);
		System.out.println(update.getCategorias());
		if(update != null) {
			return ResponseEntity.ok(update);
		}
		return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("Error al actualizar la película");
		
	}
	
	
	
	
}
