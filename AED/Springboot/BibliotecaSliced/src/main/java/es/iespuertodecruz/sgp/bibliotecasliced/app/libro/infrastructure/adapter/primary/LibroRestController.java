package es.iespuertodecruz.sgp.bibliotecasliced.app.libro.infrastructure.adapter.primary;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import es.iespuertodecruz.sgp.bibliotecasliced.app.libro.domain.Libro;
import es.iespuertodecruz.sgp.bibliotecasliced.app.libro.domain.port.primary.ILibroServicePort;


@RestController
@CrossOrigin
@RequestMapping("/api/v1/libros")
public class LibroRestController {
	
	@Autowired ILibroServicePort libroService;

	@PostMapping
	public ResponseEntity<?> save(Libro libro){
		Libro save = libroService.save(libro);
		return ResponseEntity.ok(libro);
	}
	
	@GetMapping
	public ResponseEntity<?> findAll(){
		List<Libro> findAll = libroService.findAll();
		return ResponseEntity.ok(findAll);
	}
}
