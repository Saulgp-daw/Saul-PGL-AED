package es.iespuertodelacruz.sgp.websocket.controller;

import java.security.Principal;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.messaging.handler.annotation.Header;
import org.springframework.messaging.handler.annotation.MessageMapping;
import org.springframework.messaging.handler.annotation.Payload;
import org.springframework.messaging.handler.annotation.SendTo;
import org.springframework.messaging.simp.SimpMessagingTemplate;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.CrossOrigin;

class MessageTo{
	private String autor;
	private String contenido;
	public MessageTo(String autor, String contenido) {
		super();
		this.autor = autor;
		this.contenido = contenido;
	}
	public String getAutor() {
		return autor;
	}
	public void setAutor(String autor) {
		this.autor = autor;
	}
	public String getContenido() {
		return contenido;
	}
	public void setContenido(String contenido) {
		this.contenido = contenido;
	}
	
	public String getContent() {
		return this.getAutor()+": "+this.getContenido();
		
	}
	
	
}

@Controller
@CrossOrigin
public class WebSocketController {
	@Autowired
	private SimpMessagingTemplate simpMessagingTemplate;
	@Autowired
	private MensajeService mensajeService;

	@MessageMapping("/publicmessage")
	@SendTo("/topic/chatroom")
	public MessageTo sendMessage(@Payload MessageTo chatMessage) {
		//Mensaje m = Mensaje.newPublic(chatMessage.getAuthor(),"chatroom",
		chatMessage.getContent();
		//m.setFecha(new java.util.Date());
		//Mensaje save = mensajeService.save(m);
		return chatMessage;
	}
	
	@MessageMapping("/private")
	public void sendSpecific(
	@Payload MessageTo msg,
	Principal user,
	@Header("simpSessionId") String sessionId) throws Exception {
		//Mensaje m = Mensaje.newPrivado(msg.getAuthor(),msg.getReceiver(),
		msg.getContenido();
		//m.setFecha(new java.util.Date());
		//Mensaje save = mensajeService.save(m);
		simpMessagingTemplate.convertAndSendToUser(msg.getAutor(),
		"/queue/messages", msg);
	
		}
}
