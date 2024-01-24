package es.iespuertodelacruz.sgp.tresenraya.infraestructure.adapter.primary;

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

import es.iespuertodelacruz.sgp.tresenraya.domain.port.primary.IPartidaDomainService;
import es.iespuertodelacruz.sgp.tresenraya.dto.ApuestaDTO;
import es.iespuertodelacruz.sgp.tresenraya.entities.PartidaEntity;
import es.iespuertodelacruz.sgp.tresenraya.service.PartidaService;

@RestController
@CrossOrigin
@RequestMapping("/api/v1/partidas")
public class PartidaRESTController {
	
	@Autowired
	private PartidaService partidaService;
	
	@Autowired
	private IPartidaDomainService partidaDomainService;
	
	@GetMapping("")
	public ResponseEntity<?> findAll() {
		Iterable<PartidaEntity> lista = partidaService.findAll();
		return ResponseEntity.ok(lista);
	}
	
	
	@GetMapping("/{id}")
	public ResponseEntity<?> findById(@PathVariable Integer id) {
		Optional<PartidaEntity> partidaEncontrada = partidaService.findById(id);
		return ResponseEntity.ok(partidaEncontrada);
	}
	
	@PostMapping("")
	public ResponseEntity<?> save(@RequestBody PartidaEntity partida){
		PartidaEntity save = partidaService.save(partida);
		if(save != null) {
			return ResponseEntity.ok(save);
		}

		return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("Error al guardar la partida");
	}
	
	@PostMapping("/{id}/apuestas")
	public  ResponseEntity<?> apuesta(@PathVariable int id, @RequestBody ApuestaDTO apuestaDto){
		
		Optional<PartidaEntity> partidaBuscada = partidaService.findById(id);
		
		if(partidaBuscada.isPresent()) {
			System.out.println("-----------PARTIDA ENCONTRADA");
			
			String simboloApuesta = apuestaDto.getSimbolo();
			String tablero = partidaBuscada.get().getTablero();
			String simb1 = partidaBuscada.get().getSimboloJug1();
			String simb2 = partidaBuscada.get().getSimboloJug2();
			
			long cantSimb1 = tablero.chars().filter(ch -> ch == simb1.charAt(0)).count();
			long cantSimb2 = tablero.chars().filter(ch -> ch == simb2.charAt(0)).count();
			
			System.out.println("Tablero: "+tablero);
			
			if(cantSimb1 == 0 && cantSimb2 == 0) {
				PartidaEntity update = partidaService.update(id, apuestaDto);
				if(update != null) {
					return ResponseEntity.ok(update);
				}
			}
			
			if(cantSimb1 > cantSimb2 && simb1.equals(simboloApuesta)) {
				return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("No es tu turno");
			}else if(cantSimb2 > cantSimb1 && simb2.equals(simboloApuesta) || cantSimb2 == cantSimb1 && simb2.equals(simboloApuesta)) {
				return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("No es tu turno");
				
			}else {
				PartidaEntity update = partidaService.update(apuestaDto);
				if(update != null) {
					return ResponseEntity.ok(update);
				}
			}
		}
		
		
		
		
		
		return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("Error al actualizar el tablero");
		
	}
	
	
}
