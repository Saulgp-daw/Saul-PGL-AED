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
import es.iespuertodelacruz.sgp.tresenraya.dto.PartidaDTO;
import es.iespuertodelacruz.sgp.tresenraya.entities.PartidaEntity;
import es.iespuertodelacruz.sgp.tresenraya.service.PartidaService;

@RestController
@CrossOrigin
@RequestMapping("/api/v1/partidas")
public class PartidaRESTController {

	@Autowired
	private PartidaService partidaService;

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
	public ResponseEntity<?> save(@RequestBody PartidaEntity partida) {
		PartidaEntity save = partidaService.save(partida);
		if (save != null) {
			return ResponseEntity.ok(save);
		}

		return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("Error al guardar la partida");
	}

	@PostMapping("/nueva")
	public ResponseEntity<?> nuevaPartida(@RequestBody PartidaDTO partidaDTO) {

		PartidaEntity partidaNueva = new PartidaEntity();
		partidaNueva.setIdPartida(0);
		partidaNueva.setEstado("INICIADA");
		partidaNueva.setNickJug1(partidaDTO.getNickJug1());
		partidaNueva.setNickJug2(partidaDTO.getNickJug2());
		partidaNueva.setSimboloJug1(partidaDTO.getSimboloJug1());
		partidaNueva.setSimboloJug2(partidaDTO.getSimboloJug2());
		partidaNueva.setTablero("---------");

		PartidaEntity save = partidaService.save(partidaNueva);
		if (save != null) {
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
			int posicion = apuestaDto.getPosicion();
			String tablero = partidaBuscada.get().getTablero();
			String simb1 = partidaBuscada.get().getSimboloJug1();
			String simb2 = partidaBuscada.get().getSimboloJug2();
			
			
			System.out.println("Posicion: "+posicion);
			System.out.println("Simbolo: "+simboloApuesta);
			System.out.println("Tablero antiguo: "+tablero);
			
			String tableroNuevo = reemplazarCaracter(tablero, posicion, simboloApuesta);
			System.out.println("Tablero nuevo: "+tableroNuevo);
			
			if(partidaBuscada.get().getNickJug2().equals("CPU") && tableroNuevo.contains("-")) {
				
				char[] tableroArray = tableroNuevo.toCharArray();
				int rndPos = 0 ;
				do {
				    rndPos = (int) Math.floor(Math.random() * (tableroArray.length - 1));
				} while (tableroArray[rndPos] != '-');
				System.out.println("Pos aleatoria"+ rndPos);
				
				

				tableroNuevo = reemplazarCaracter(tableroNuevo, rndPos, simb2);
			}
			
			if(!tablero.contains("-")) {
				partidaBuscada.get().setEstado("FINALIZADA");
				partidaService.update(partidaBuscada.get());
			}
			
			if(partidaBuscada.get().getEstado() == "FINALIZADA") {
				return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("Partida Finalizada");
			}
			
			
			long cantSimb1 = tablero.chars().filter(ch -> ch == simb1.charAt(0)).count();
			long cantSimb2 = tablero.chars().filter(ch -> ch == simb2.charAt(0)).count();
			
			System.out.println("Tablero: "+tablero);
			
			if(cantSimb1 == 0 && cantSimb2 == 0) {
				PartidaEntity update = partidaService.apuesta(id, tableroNuevo);
				if(update != null) {
					return ResponseEntity.ok(update);
				}
			}
			
			if(cantSimb1 > cantSimb2 && simb1.equals(simboloApuesta)) {
				return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("No es tu turno");
			}else if(cantSimb2 > cantSimb1 && simb2.equals(simboloApuesta) || cantSimb2 == cantSimb1 && simb2.equals(simboloApuesta)) {
				return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("No es tu turno");
				
			}else {
				PartidaEntity update = partidaService.apuesta(id, tableroNuevo);
				
				
				if(!tableroNuevo.contains("-")) {
					update.setEstado("FINALIZADA");
					partidaService.update(update);
				}
				if(update != null) {
					return ResponseEntity.ok(update);
				}
			}
		}
		
		return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("Error al actualizar el tablero");
		
	}

	public static String reemplazarCaracter(String tableroOriginal, int posicion, String simbolo) {
		if (posicion < 0 || posicion > tableroOriginal.length()) {
			throw new IllegalArgumentException("Posición fuera de rango");
		}

		char[] caracteres = tableroOriginal.toCharArray();
		caracteres[posicion] = simbolo.charAt(0);

		return new String(caracteres);

	}

}
