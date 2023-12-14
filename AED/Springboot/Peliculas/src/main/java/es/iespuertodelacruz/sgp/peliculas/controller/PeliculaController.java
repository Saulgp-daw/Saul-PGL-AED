package es.iespuertodelacruz.sgp.peliculas.controller;

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
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.multipart.MultipartFile;

import es.iespuertodelacruz.sgp.peliculas.dto.PeliculaDTO;
import es.iespuertodelacruz.sgp.peliculas.entities.Pelicula;
import es.iespuertodelacruz.sgp.peliculas.service.FileStorageService;
import es.iespuertodelacruz.sgp.peliculas.service.PeliculaService;
import jakarta.transaction.Transactional;

@RestController
@CrossOrigin
@RequestMapping("/api/peliculas")
public class PeliculaController {
	@Autowired
	private PeliculaService peliculaService;

	@Autowired
	private FileStorageService storageService;

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

	@DeleteMapping("/{id}")
	public ResponseEntity<?> delete(@PathVariable Integer id) {
		Optional<Pelicula> peliABorrar = peliculaService.findById(id);
		if (peliABorrar.isPresent()) {
			peliculaService.deleteById(id);
			return ResponseEntity.ok("pelicula borrada");
		} else {
			return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("el id del registro no existe");
		}
	}

	@PostMapping("")
	public ResponseEntity<?> save(@RequestBody Pelicula pelicula) {

		Pelicula save = peliculaService.save(pelicula);
		if (save != null) {
			return ResponseEntity.ok(save);
		}

		return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("Error al guardar la película");
	}

	@PutMapping("")
	public ResponseEntity<?> update(@RequestBody Pelicula pelicula) {
		Pelicula update = peliculaService.update(pelicula);
		System.out.println(update.getCategorias());
		if (update != null) {
			return ResponseEntity.ok(update);
		}
		return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("Error al actualizar la película");

	}

	@PostMapping("/upload")
	public ResponseEntity<?> uploadFile(@RequestParam("file") MultipartFile file) {
		String message = "";
		try {
			String namefile = storageService.save(file);

			message = "" + namefile;
			return ResponseEntity.status(HttpStatus.OK).body(message);
		} catch (Exception e) {
			message = "Could not upload the file: " + file.getOriginalFilename() + ". Error: " + e.getMessage();
			return ResponseEntity.status(HttpStatus.EXPECTATION_FAILED).body(message);
		}
	}

	
	@PostMapping("/base64")
	public ResponseEntity<?> nuevaPelicula(@RequestBody PeliculaDTO peliDto) {
		Pelicula pelicula = new Pelicula();
		pelicula.setTitulo(peliDto.getTitulo());
		pelicula.setActores(peliDto.getActores());
		pelicula.setArgumento(peliDto.getArgumento());
		pelicula.setDireccion(peliDto.getDireccion());
		pelicula.setTrailer(peliDto.getTrailer());
		pelicula.setCategorias(peliDto.getLista());
		String codedfoto = peliDto.getFotoBase64();
		byte[] photoBytes = Base64.getDecoder().decode(codedfoto);
		String nombreNuevoFichero = storageService.save(peliDto.getNombreFichero(), photoBytes);
		pelicula.setImagen(nombreNuevoFichero+".jpg");
		Pelicula save = peliculaService.save(pelicula);
		return ResponseEntity.ok(save);
	}

}