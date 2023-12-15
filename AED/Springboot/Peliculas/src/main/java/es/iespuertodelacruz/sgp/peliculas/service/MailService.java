package es.iespuertodelacruz.sgp.peliculas.service;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Value;

public class MailService {
	@Autowired
	private JavaMailSender sender;
	@Value("${mail.from}")
	private String mailfrom;

	public void send(String destinatario, String asunto, String contenido) {
		SimpleMailMessage message = new SimpleMailMessage();
		message.setFrom(mailfrom);
		message.setTo(destinatario);
		message.setSubject(asunto);
		message.setText(contenido);
		sender.send(message);
	}
}