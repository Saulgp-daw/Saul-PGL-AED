package es.iespuertodelacruz.jc.websocketpiedrapapeltijera.controller;

import java.security.Principal;
import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.messaging.handler.annotation.Header;
import org.springframework.messaging.handler.annotation.MessageMapping;
import org.springframework.messaging.handler.annotation.Payload;
import org.springframework.messaging.handler.annotation.SendTo;
import org.springframework.messaging.simp.SimpMessagingTemplate;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.CrossOrigin;

import es.iespuertodelacruz.jc.websocketpiedrapapeltijera.entity.PiedraPapelTijeraEntity;
import es.iespuertodelacruz.jc.websocketpiedrapapeltijera.repository.PartidaRepository;
import es.iespuertodelacruz.jc.websocketpiedrapapeltijera.service.PartidaService;


class Respuesta{
	public Respuesta() {}
	String idPartida;
	String estadoPartida;
	String jugador1;
	String jugador2;
	String peticionRealizada;
	String respuesta;
	String resultado;


	public String getResultado() {
		return resultado;
	}
	public void setResultado(String resultado) {
		this.resultado = resultado;
	}
	public String getIdPartida() {
		return idPartida;
	}
	public void setIdPartida(String idPartida) {
		this.idPartida = idPartida;
	}
	public String getEstadoPartida() {
		return estadoPartida;
	}
	public void setEstadoPartida(String estadoPartida) {
		this.estadoPartida = estadoPartida;
	}
	public String getJugador1() {
		return jugador1;
	}
	public void setJugador1(String jugador1) {
		this.jugador1 = jugador1;
	}
	public String getJugador2() {
		return jugador2;
	}
	public void setJugador2(String jugador2) {
		this.jugador2 = jugador2;
	}
	public String getPeticionRealizada() {
		return peticionRealizada;
	}
	public void setPeticionRealizada(String peticionRealizada) {
		this.peticionRealizada = peticionRealizada;
	}
	public String getRespuesta() {
		return respuesta;
	}
	public void setRespuesta(String respuesta) {
		this.respuesta = respuesta;
	}
}


class RequestPartida{
	
	public RequestPartida() {}
	String peticion;
	String idPartida;
	String apuesta;


	public String getPeticion() {
		return peticion;
	}
	public void setPeticion(String peticion) {
		this.peticion = peticion;
	}
	public String getIdPartida() {
		return idPartida;
	}
	public void setIdPartida(String idPartida) {
		this.idPartida = idPartida;
	}
	public String getApuesta() {
		return apuesta;
	}
	public void setApuesta(String apuesta) {
		this.apuesta = apuesta;
	}

	
}



class Mensaje{
	
	public Mensaje() {}
	String author;
	String receiver;
	String content;
	
	public Mensaje(String author, String receiver, String content) {
		super();
		this.author = author;
		this.receiver = receiver;
		this.content = content;
	}
	public String getAuthor() {
		return author;
	}
	public void setAuthor(String author) {
		this.author = author;
	}
	public String getReceiver() {
		return receiver;
	}
	public void setReceiver(String receiver) {
		this.receiver = receiver;
	}
	public String getContent() {
		return content;
	}
	public void setContent(String content) {
		this.content = content;
	}
	
	
}




@Controller
@CrossOrigin
public class WebsocketController { //el controlador es para una conexión establecida en: ws://ip_de_la_api:8080/websocket
	
	@Autowired
	private SimpMessagingTemplate simpMessagingTemplate;
	
	@Autowired
	private PartidaService partidaService;
	

	
	//se manejan los mensajes enviados a la ruta (recibida por el websocket ) de:  /app/publicmessage
	//y lo que corresponde hacer se envía a la ruta: /topic/chatroom y lo recibirán los que estén suscritos 
    @MessageMapping("/mensajegeneral")
    @SendTo("/salas/general")
    public Mensaje enviarGeneral(@Payload Mensaje chatMessage,
    	      Principal user, 
    	      @Header("simpSessionId") String sessionId
    		
	) {
        return chatMessage;
    }
    
    

    @MessageMapping("/privado") 
    public void enviarPrivado(    		
     @Payload Mensaje msg, 
     Principal user, 
     @Header("simpSessionId") String sessionId) throws Exception { 
    	simpMessagingTemplate.convertAndSendToUser(
    			msg.getReceiver(), 
    			"/cola/mensajes", 
    			msg
    	);  
    
    }
    
    
    
    @MessageMapping("/jugar") 
    public void jugar(    		
     @Payload RequestPartida msg, 
     Principal user, 
     @Header("simpSessionId") String sessionId) throws Exception { 
    	
    	Respuesta respuesta = new Respuesta();
 
    	PiedraPapelTijeraEntity partida = null;
    	
    	switch(msg.getPeticion()) {
    		case "NUEVA": 
    			partida = new PiedraPapelTijeraEntity(user.getName());
    			PiedraPapelTijeraEntity save = partidaService.save(partida);
    			respuesta.estadoPartida = save.getEstado();
    			respuesta.idPartida = ""+save.getId();
    			respuesta.jugador1 = save.getJugador1();
    			respuesta.jugador2 = save.getJugador2();
    			respuesta.peticionRealizada = msg.getPeticion();
    			respuesta.resultado = save.getResultado();
    			respuesta.respuesta = "ok partida creada";
    	    	simpMessagingTemplate.convertAndSendToUser(
    	    			user.getName(), 
    	    			"/cola/partidas", 
    	    			respuesta
    	    	);    	
    			
    			break;
    			
    		case "UNIRSE": 
    			List<PiedraPapelTijeraEntity> partidasEsperando = partidaService.findJugador2Null();
    			if(partidasEsperando != null && partidasEsperando.size() > 0) {
    				partida = partidasEsperando.get(0);
    				partida.establecerJugador2(user.getName());
        			PiedraPapelTijeraEntity update = partidaService.save(partida);
        			respuesta.estadoPartida = update.getEstado();
        			respuesta.idPartida = ""+update.getId();
        			respuesta.jugador1 = update.getJugador1();
        			respuesta.jugador2 = update.getJugador2();
        			respuesta.peticionRealizada = msg.getPeticion();
        			respuesta.resultado = update.getResultado();
        			respuesta.respuesta = "ok unido a partida";
        	    	simpMessagingTemplate.convertAndSendToUser(
        	    			user.getName(), 
        	    			"/cola/partidas", 
        	    			respuesta
        	    	);      
        	    	simpMessagingTemplate.convertAndSendToUser(
        	    			update.getJugador1(), 
        	    			"/cola/partidas", 
        	    			respuesta
        	    	);            	    	
    			}else {
    				respuesta.respuesta = "No hay partidas disponibles";
        	    	simpMessagingTemplate.convertAndSendToUser(
        	    			user.getName(), 
        	    			"/cola/partidas", 
        	    			respuesta
        	    	);      				
    			}
    			break;
    			
    		case "APOSTAR":{
    			Integer idPartida = null;
    			try {
    				idPartida = Integer.parseInt(msg.getIdPartida());
    			}catch( Exception ex) {}
    			
    			if( idPartida != null) {
    				partida = partidaService.findById(idPartida);
    			}
				if( partida != null) {
					boolean okApostar = partida.apostar(user.getName(), msg.getApuesta());
					partida = partidaService.save(partida);
        			respuesta.estadoPartida = partida.getEstado();
        			respuesta.idPartida = ""+partida.getId();
        			respuesta.jugador1 = partida.getJugador1();
        			respuesta.jugador2 = partida.getJugador2();
        			respuesta.peticionRealizada = msg.getPeticion();
        			respuesta.resultado = partida.getResultado(); 
        			if( okApostar) {
        				respuesta.respuesta = "ok apuesta se ha realizado";
        			}else {
        				respuesta.respuesta = "nak No se ha podido realizar la apuesta";
        			}
        	    	simpMessagingTemplate.convertAndSendToUser(
        	    			partida.getJugador1(), 
        	    			"/cola/partidas", 
        	    			respuesta
        	    	);      
        	    	simpMessagingTemplate.convertAndSendToUser(
        	    			partida.getJugador2(), 
        	    			"/cola/partidas", 
        	    			respuesta
        	    	);    					
				}
    		}
    	}


    }
   
        
  
}