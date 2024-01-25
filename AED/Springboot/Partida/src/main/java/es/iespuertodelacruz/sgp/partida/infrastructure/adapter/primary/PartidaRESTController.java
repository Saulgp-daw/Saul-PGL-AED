package es.iespuertodelacruz.sgp.partida.infrastructure.adapter.primary;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import es.iespuertodelacruz.sgp.partida.domain.model.Partida;
import es.iespuertodelacruz.sgp.partida.domain.port.primary.IPartidaDomainService;

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
	
	

}
