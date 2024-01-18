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
import org.springframework.web.bind.annotation.RestController;

import es.iespuertodelacruz.sgp.instituto.entities.Asignatura;
import es.iespuertodelacruz.sgp.instituto.service.AsignaturaService;

@RestController
@CrossOrigin
@RequestMapping("/api/v1/asignaturas")
public class AsignaturaController {

	@Autowired
	private AsignaturaService asignaturaService;

	@GetMapping("")
	public ResponseEntity<?> findAll() {
		Iterable<Asignatura> lista = asignaturaService.findAll();
		return ResponseEntity.ok(lista);
	}

	@GetMapping("/{id}")
	public ResponseEntity<?> findById(@PathVariable Integer id) {
		Optional<Asignatura> element = asignaturaService.findById(id);
		return ResponseEntity.ok(element);
	}

	@PostMapping("")
	public ResponseEntity<?> save(Asignatura asignatura) {
		Asignatura save = asignaturaService.save(asignatura);
		return ResponseEntity.ok(save);
	}

	@DeleteMapping("/{id}")
	public ResponseEntity<?> delete(@PathVariable Integer id) {
		Optional<Asignatura> asignaturaABorrar = asignaturaService.findById(id);
		if (asignaturaABorrar.isPresent()) {
			asignaturaService.deleteById(id);
			return ResponseEntity.ok("Asignatura borrada");
		} else {
			return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("el id del registro no existe");
		}
	}

	@PutMapping("/{id}")
	public ResponseEntity<?> update(@PathVariable Integer id, @RequestBody Asignatura asignatura){
		
			Asignatura update = asignaturaService.update(id, asignatura);
			if (update != null) {
				return ResponseEntity.ok(update);
			}
			return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("Error al actualizar la asignatura");
		
		
	}
}
