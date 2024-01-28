package es.iespuertodelacruz.sgp.partida.infrastructure.adapter.secondary;

import es.iespuertodelacruz.sgp.partida.domain.model.Partida;

public class PartidaDocumentMapper {
	
	public Partida toDomain(PartidaDocument pd) {
		Partida partida = null;
		if(pd != null) {
			partida = new Partida(pd.getIdPartida(), pd.getEstado(), pd.getNick_jug1(), pd.getNick_jug2(), pd.getSimbolo_jug1(), pd.getSimbolo_jug2(), pd.getTablero() );
		}
		return partida;
	}
	
	public PartidaDocument toDocument(Partida p) {
		PartidaDocument pd = null;
		if(p != null) {
			pd = new PartidaDocument();
			pd.setIdPartida(p.getIdPartida());
			pd.setEstado(p.getEstado());
			pd.setNick_jug1(p.getNickJug1());
			pd.setNick_jug2(p.getNickJug2());
			pd.setSimbolo_jug1(p.getSimboloJug1());
			pd.setSimbolo_jug2(p.getSimboloJug2());
			pd.setTablero(p.getTablero());
		}
		return pd;
	}

}
