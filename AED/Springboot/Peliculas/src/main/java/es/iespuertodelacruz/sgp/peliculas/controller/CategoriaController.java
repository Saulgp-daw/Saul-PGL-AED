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
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import es.iespuertodelacruz.sgp.peliculas.entities.Categoria;
import es.iespuertodelacruz.sgp.peliculas.service.CategoriaService;

@RestController
@CrossOrigin
@RequestMapping("/api/categorias")
public class CategoriaController {

	@Autowired
	private CategoriaService categoriaService;
	
	@GetMapping("")
	public ResponseEntity<?> findAll(){
		Iterable<Categoria> findAll = categoriaService.findAll();
		return ResponseEntity.ok(findAll);
	}
	
	@GetMapping("/{id}")
	public ResponseEntity<?> findbyId(@PathVariable Integer id){
		Optional<Categoria> findById = categoriaService.findById(id);
		return ResponseEntity.ok(findById);
	}
	
	@PostMapping("")
	public ResponseEntity<?> save(@RequestBody Categoria cat){
		Categoria save = categoriaService.save(cat);
		return ResponseEntity.ok(save);
	}
	
	@DeleteMapping("/{id}")
	public ResponseEntity<?> delete(@PathVariable Integer id){
		Optional<Categoria> catABorrar = categoriaService.findById(id);
		if(catABorrar.isPresent()) {
			categoriaService.deleteById(id);
			return ResponseEntity.ok("Categoría borrada");
		}else {
			return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("el id del registro no existe");
		}
	}
	
}
