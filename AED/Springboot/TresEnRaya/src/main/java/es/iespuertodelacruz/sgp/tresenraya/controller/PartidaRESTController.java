package es.iespuertodelacruz.sgp.tresenraya.controller;

import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import es.iespuertodelacruz.sgp.tresenraya.dto.ApuestaDTO;
import es.iespuertodelacruz.sgp.tresenraya.entities.Partida;
import es.iespuertodelacruz.sgp.tresenraya.service.PartidaService;

@RestController
@CrossOrigin
@RequestMapping("/api/v1/partidas")
public class PartidaRESTController {
	
	@Autowired
	private PartidaService partidaService;
	
	@GetMapping("/{id}")
	public ResponseEntity<?> findById(@PathVariable Integer id) {
		Optional<Partida> partidaEncontrada = partidaService.findById(id);
		return ResponseEntity.ok(partidaEncontrada);
	}
	
	@PostMapping("")
	public ResponseEntity<?> save(@RequestBody Partida partida){
		Partida save = partidaService.save(partida);
		if(save != null) {
			return ResponseEntity.ok(save);
		}

		return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("Error al guardar la partida");
	}
	
	@PostMapping("/{id}/apuestas")
	public  ResponseEntity<?> apuesta(@RequestBody ApuestaDTO apuestaDto){
		
		//System.out.println("-------------------"+apuestaDto.getIdPartida());
		//System.out.println("-------------------"+apuestaDto.getTablero());
		Partida update = partidaService.update(apuestaDto);
		
		if(update != null) {
			return ResponseEntity.ok(update);
		}
		
		return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("Error al actualizar el tablero");
		
	}
	
	
}
