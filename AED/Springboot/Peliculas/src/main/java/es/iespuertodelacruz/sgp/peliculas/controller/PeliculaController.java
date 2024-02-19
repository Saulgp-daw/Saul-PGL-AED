package es.iespuertodelacruz.sgp.peliculas.controller;

import java.io.IOException;
import java.net.URLConnection;
import java.util.Base64;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.core.io.Resource;
import org.springframework.http.HttpStatus;
import org.springframework.http.MediaType;
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
import org.springframework.web.multipart.MultipartFile;

import es.iespuertodelacruz.sgp.peliculas.dto.PeliculaDTO;
import es.iespuertodelacruz.sgp.peliculas.entities.Pelicula;
import es.iespuertodelacruz.sgp.peliculas.service.FileStorageService;
import es.iespuertodelacruz.sgp.peliculas.service.PeliculaService;

@RestController
@CrossOrigin
@RequestMapping("/api/v1/peliculas")
public class PeliculaController {
	@Autowired
	private PeliculaService peliculaService;

	@Autowired
	private FileStorageService storageService;

	@GetMapping("")
	public ResponseEntity<?> hola() {
		Iterable<Pelicula> lista = peliculaService.findAll();
		return ResponseEntity.ok(lista);
	}
	
	@GetMapping("")
	public ResponseEntity<?> findAll() {
		Iterable<Pelicula> lista = peliculaService.findAll();
		return ResponseEntity.ok(lista);
	}

	@GetMapping("/{id}")
	public ResponseEntity<?> findById(@PathVariable Integer id) {
		Optional<Pelicula> peliculaEncontrada = peliculaService.findById(id);
		return ResponseEntity.ok(peliculaEncontrada);
	}


	@GetMapping("/ficheros/{filename}")
	public ResponseEntity<?> getFiles(@PathVariable String filename) {
		Resource resource = storageService.get(filename);
		// Try to determine file's content type
		String contentType = null;
		try {
			contentType = URLConnection.guessContentTypeFromStream(resource.getInputStream());
		} catch (IOException ex) {
			System.out.println("Could not determine file type.");
		}
		// Fallback to the default content type if type could not be determined
		if (contentType == null) {
			contentType = "application/octet-stream";
		}
		String headerValue = "attachment; filename=\"" + resource.getFilename() + "\"";
		return ResponseEntity.ok().contentType(MediaType.parseMediaType(contentType))
				.header(org.springframework.http.HttpHeaders.CONTENT_DISPOSITION, headerValue).body(resource);
	}

}
