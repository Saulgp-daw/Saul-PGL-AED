package es.iespuertodelacruz.sgp.instituto.controller;

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
import org.springframework.web.bind.annotation.RestController;

import es.iespuertodelacruz.sgp.instituto.dto.AlumnoDTO;
import es.iespuertodelacruz.sgp.instituto.entities.Alumno;
import es.iespuertodelacruz.sgp.instituto.service.AlumnoService;
import es.iespuertodelacruz.sgp.instituto.service.FileStorageService;

@RestController
@CrossOrigin
@RequestMapping("/api/v2/alumnos")
public class AlumnoControllerV2 {

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
	
	@PostMapping("")
	public ResponseEntity<?> save(@RequestBody AlumnoDTO alumnoDTO){
		Alumno alumno = new Alumno();
		alumno.setDni(alumnoDTO.getDni());
		alumno.setNombre(alumnoDTO.getNombre());
		alumno.setApellidos(alumnoDTO.getApellidos());
		alumno.setFechanacimiento(alumnoDTO.getFechanacimiento());
		//alumno.setMatriculas(alumnoDTO.getMatriculas());
		String codedfoto = alumnoDTO.getBase64();
		byte[] photoBytes = Base64.getDecoder().decode(codedfoto);
		String nombreNuevoFichero = storageService.save(alumnoDTO.getImagen(), photoBytes);
		
		alumno.setImagen(nombreNuevoFichero);
		System.out.println("---------------------------------"+alumno.getMatriculas());
		Alumno save = alumnoService.save(alumno);
		return ResponseEntity.ok(save);
		
	}
	
	@DeleteMapping("/{dni}")
	public ResponseEntity<?> delete(@PathVariable String dni){
		Optional<Alumno> alumnoABorrar = alumnoService.findById(dni);
		if(alumnoABorrar.isPresent()) {
			alumnoService.deleteById(dni);
			return ResponseEntity.ok("alumno borrado");
		} else {
			return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("el id del registro no existe");
		}
	}
	
	@PutMapping("/{dni}")
	public ResponseEntity<?> update(@PathVariable String dni, @RequestBody AlumnoDTO alumnoDto){
		Optional<Alumno> alumnoEncontrado = alumnoService.findById(dni);
		
		if(alumnoEncontrado.isPresent()) {
			Alumno alumno = new Alumno();
			alumno.setDni(alumnoEncontrado.get().getDni());
			alumno.setNombre(alumnoDto.getNombre());
			alumno.setApellidos(alumnoDto.getApellidos());
			alumno.setFechanacimiento(alumnoDto.getFechanacimiento());
			alumno.setImagen(alumnoDto.getImagen());
			Alumno update = alumnoService.update(alumno);
			
			if(update != null) {
				return ResponseEntity.ok(update);
			}
		}
		
		
		return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("Error al actualizar alumno");

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
