package es.iespuertodelacruz.sgp.partida.infrastructure.adapter.secondary;

import es.iespuertodelacruz.sgp.partida.domain.model.Partida;

public class PartidaEntityMapper {

	public Partida toDomain(PartidaEntity pe) {
		Partida partida = null;
		if(pe != null) {
			partida = new Partida(pe.getIdPartida()+"", pe.getEstado(), pe.getNickJug1(), pe.getNickJug2(), pe.getSimboloJug1(), pe.getSimboloJug2(), pe.getTablero());
			
		}
		return partida;
	}
	
	public PartidaEntity toEntity(Partida p) {
		PartidaEntity pe = null;
		if(p != null) {
			pe = new PartidaEntity();
			pe.setIdPartida(Integer.parseInt(p.getIdPartida()));
			pe.setEstado(p.getEstado());
			pe.setNickJug1(p.getNickJug1());
			pe.setNickJug2(p.getNickJug2());
			pe.setSimboloJug1(p.getSimboloJug1());
			pe.setSimboloJug2(p.getSimboloJug2());
			pe.setTablero(p.getTablero());
		}
		return pe;
	}
}
