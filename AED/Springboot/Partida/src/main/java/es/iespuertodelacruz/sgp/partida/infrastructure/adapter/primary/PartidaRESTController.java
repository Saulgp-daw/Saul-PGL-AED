package es.iespuertodelacruz.sgp.partida.infrastructure.adapter.primary;

import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import es.iespuertodelacruz.sgp.partida.domain.model.Partida;
import es.iespuertodelacruz.sgp.partida.domain.port.primary.IPartidaDomainService;
import es.iespuertodelacruz.sgp.partida.infrastructure.adapter.primary.dto.ApuestaDTO;
import es.iespuertodelacruz.sgp.partida.infrastructure.adapter.primary.dto.PartidaDTO;
import es.iespuertodelacruz.sgp.partida.infrastructure.adapter.primary.dto.UnirseDTO;

@RestController
@CrossOrigin
@RequestMapping("/api/v1/partidas")
public class PartidaRESTController {

	@Autowired
	IPartidaDomainService partidaDomainService;

	@GetMapping
	public ResponseEntity<?> findAll() {
		List<Partida> lista = partidaDomainService.findAll();
		return ResponseEntity.ok(lista);
	}

	@GetMapping("/{id}")
	public ResponseEntity<?> findById(@PathVariable Integer id) {
		Partida partidaEncontrada = partidaDomainService.findById(id);
		if (partidaEncontrada != null) {
			return ResponseEntity.ok(partidaEncontrada);
		}
		return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("Partida no encontrada");

	}

	@PostMapping("/nueva")
	public ResponseEntity<?> nuevaPartida(@RequestBody PartidaDTO partidaDto) {
		Partida partida = new Partida(0 + "", "ESPERA", partidaDto.getNickJug1(), "", partidaDto.getSimboloJug1(), "",
				"---------");
		Partida save = partidaDomainService.save(partida);
		if (save != null) {
			return ResponseEntity.ok(save);
		}
		return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("Error al crear la partida");
	}

	@PutMapping("/{id}/unirse")
	public ResponseEntity<?> unirse(@PathVariable int id, @RequestBody UnirseDTO unirseDto) {

		Partida partida = partidaDomainService.findById(id);

		if (partida != null) {
			if (partida.getEstado().equals("ESPERA")) {
				partida.setEstado("INICIADA");
				partida.setNickJug2(unirseDto.getNickJug2());
				partida.setSimboloJug2(unirseDto.getSimboloJug2());
				Partida update = partidaDomainService.update(partida);
				if (update != null) {
					return ResponseEntity.ok(update);
				}
				return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("Error al actualizar");
			}
			return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("Esta partida ya está iniciada");
		}
		return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("No existe la partida");
	}

	@PostMapping("/{id}/apuestas")
	public ResponseEntity<?> apuesta(@PathVariable int id, @RequestBody ApuestaDTO apuestaDto) {
		Partida partida = partidaDomainService.findById(id);
		if (partida != null) {
			String respuesta = partida.apuesta(apuestaDto.getSimbolo(), apuestaDto.getPosicion());
			switch (respuesta) {
			case "FINALIZADA":
			case "EMPATE":
				return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("La partida está finalizada");
			case "COGIDA":
				return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("La posición está cogida");
			case "TURNO":
				return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("No es tu turno");
			case "SIMBOLO":
				return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("No hay nadie con este simbolo");
			case "OK":
				Partida update = partidaDomainService.update(partida);
				if (update != null) {
					return ResponseEntity.ok(update);
				}
			}

		}
		return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("Error al actualizar el tablero");
	}
	
	@GetMapping("/estado/{estado}")
	public ResponseEntity<?> findByEstado(@PathVariable String estado) {
		List<Partida> lista = partidaDomainService.findByEstado(estado.toUpperCase());
		return ResponseEntity.ok(lista);
	}
	

}
