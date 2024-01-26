package es.iespuertodelacruz.sgp.partida.infrastructure.adapter.primary;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import es.iespuertodelacruz.sgp.partida.domain.model.Partida;
import es.iespuertodelacruz.sgp.partida.domain.port.primary.IPartidaDomainService;
import es.iespuertodelacruz.sgp.partida.infrastructure.adapter.primary.dto.ApuestaDTO;
import es.iespuertodelacruz.sgp.partida.infrastructure.adapter.primary.dto.PartidaDTO;

@RestController
@CrossOrigin
@RequestMapping("/api/v1/partidas")
public class PartidaRESTController{

	@Autowired IPartidaDomainService partidaDomainService;
	
	@GetMapping
	public ResponseEntity<?> findAll(){
		List<Partida> lista = partidaDomainService.findAll();
		return ResponseEntity.ok(lista);
	}
	
	@GetMapping("/{id}")
	public ResponseEntity<?> findById(@PathVariable Integer id) {
		Partida partidaEncontrada = partidaDomainService.findById(id);
		return ResponseEntity.ok(partidaEncontrada);
	}
	
	/*
	@PostMapping("")
	public ResponseEntity<?> save(@RequestBody PartidaEntity partida) {
		PartidaEntity save = partidaService.save(partida);
		if (save != null) {
			return ResponseEntity.ok(save);
		}

		return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("Error al guardar la partida");
	}
	*/
	
	@PostMapping("/nueva")
	public ResponseEntity<?> nuevaPartida(@RequestBody PartidaDTO partidaDto){
		System.out.println("Simbolo j1: "+partidaDto.getSimboloJug1().length());
		Partida partida = new Partida(0, "INICIADA", partidaDto.getNickJug1(), partidaDto.getNickJug2(), partidaDto.getSimboloJug1(), partidaDto.getSimboloJug2(), "---------" );
		Partida save = partidaDomainService.save(partida);
		return ResponseEntity.ok(save);
	}
	
	

}
