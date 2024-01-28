package es.iespuertodelacruz.sgp.partida.infrastructure.adapter.secondary;

import java.util.List;
import java.util.Optional;
import java.util.stream.Collectors;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Sort;
import org.springframework.data.mongodb.core.MongoTemplate;
import org.springframework.data.mongodb.core.query.Query;
import org.springframework.stereotype.Service;

import es.iespuertodelacruz.sgp.partida.domain.model.Partida;
import es.iespuertodelacruz.sgp.partida.domain.port.secondary.IPartidaDomainRepository;

//@Service
public class PartidaDocumentService implements IPartidaDomainRepository{
	
	@Autowired
	IPartidaRepositoryDocument pdRepository;
	
	PartidaDocumentMapper mapper = new PartidaDocumentMapper();
	
	@Autowired
    private MongoTemplate mongoTemplate;

	@Override
	public List<Partida> findAll() {
		List<PartidaDocument> lista = pdRepository.findAll();
		return lista.stream().map(pd -> mapper.toDomain(pd)).collect(Collectors.toList());
	}

	@Override
	public Partida findById(Integer id) {
		Partida partida = null;
		if (id != null) {
			Optional<PartidaDocument> opt = pdRepository.findById(id+"");
			if(opt.isPresent()) {
				PartidaDocument partidaDocument = opt.get();
				partida = mapper.toDomain(partidaDocument);
			}
		}
		return partida;
	}

	@Override
	public Partida save(Partida partida) {
		if(partida != null) {
			PartidaDocument pd = mapper.toDocument(partida);
			pd.setIdPartida((Integer.parseInt(obtenerUltimoId().toString())+1)+"");
			PartidaDocument save = pdRepository.save(pd);
			return mapper.toDomain(save);
			//System.out.println("Último id: "+obtenerUltimoId());
		}
		return null;
	}
	
	
	
	 public Object obtenerUltimoId() {
	        // Crea un objeto Query con sort por _id de forma descendente y limita a 1 resultado
	        Query query = new Query().with(Sort.by(Sort.Order.desc("_id"))).limit(1);

	        // Ejecuta la consulta y proyecta solo el campo _id
	        PartidaDocument resultado = mongoTemplate.findOne(query, PartidaDocument.class, "partidas");

	        // Devuelve el valor de _id del resultado
	        return resultado != null ? resultado.getIdPartida() : 0;
	    }

	@Override
	public Partida update(Partida partida) {
		Optional<PartidaDocument> opt = pdRepository.findById(partida.getIdPartida());
		if(opt.isPresent()) {
			PartidaDocument pd = mapper.toDocument(partida);
			pd.setIdPartida(partida.getIdPartida());
			pd.setEstado(partida.getEstado());
			pd.setNick_jug1(partida.getNickJug1());
			pd.setNick_jug2(partida.getNickJug2());
			pd.setSimbolo_jug1(partida.getSimboloJug1());
			pd.setSimbolo_jug2(partida.getSimboloJug2());
			pd.setTablero(partida.getTablero());
			PartidaDocument update = pdRepository.save(pd);
			return mapper.toDomain(update);
		}
		return null;
	}

	@Override
	public List<Partida> findByEstado(String estado) {
		List<PartidaDocument> lista = pdRepository.findByEstado(estado);
		return lista.stream().map(pd -> mapper.toDomain(pd)).collect(Collectors.toList());
	}
	

}
