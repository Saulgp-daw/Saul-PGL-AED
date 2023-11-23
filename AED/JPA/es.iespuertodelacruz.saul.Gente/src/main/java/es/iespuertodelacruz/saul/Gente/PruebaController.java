package es.iespuertodelacruz.saul.Gente;

import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@CrossOrigin
@RequestMapping("/api/personas")
public class PruebaController {

	@GetMapping
	public ResponseEntity<?> getAll() {
		return ResponseEntity.ok("Esta respuesta es de prueba");

	}

}
