package es.iespuertodelacruz.jc.ejemplowebsocketseguro.config;





import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.context.annotation.Configuration;
import org.springframework.core.Ordered;
import org.springframework.core.annotation.Order;
import org.springframework.messaging.Message;
import org.springframework.messaging.MessageChannel;
import org.springframework.messaging.simp.config.ChannelRegistration;
import org.springframework.messaging.simp.config.MessageBrokerRegistry;
import org.springframework.messaging.simp.stomp.StompCommand;
import org.springframework.messaging.simp.stomp.StompHeaderAccessor;
import org.springframework.messaging.support.ChannelInterceptor;
import org.springframework.messaging.support.MessageHeaderAccessor;
import org.springframework.security.authentication.UsernamePasswordAuthenticationToken;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.web.socket.config.annotation.EnableWebSocketMessageBroker;
import org.springframework.web.socket.config.annotation.StompEndpointRegistry;
import org.springframework.web.socket.config.annotation.WebSocketMessageBrokerConfigurer;

import es.iespuertodelacruz.jc.ejemplowebsocketseguro.document.UsuarioDocument;
import es.iespuertodelacruz.jc.ejemplowebsocketseguro.documentservice.UsuarioDocumentService;
import es.iespuertodelacruz.jc.ejemplowebsocketseguro.security.JwtService;
import es.iespuertodelacruz.jc.ejemplowebsocketseguro.security.UserDetailsLogin;

@Configuration
@EnableWebSocketMessageBroker
@Order(Ordered.HIGHEST_PRECEDENCE + 99)
public class WebSocketConfig implements WebSocketMessageBrokerConfigurer {

	
	@Autowired JwtService jwtService;
	@Autowired private UsuarioDocumentService usuarioservice;
	
    @Override
    public void registerStompEndpoints(StompEndpointRegistry registry) {
        registry.addEndpoint("/websocket").setAllowedOriginPatterns("*")
        //.withSockJS()
        ;
    }

    @Override
    public void configureMessageBroker(MessageBrokerRegistry registry) {
        registry.enableSimpleBroker("/salas","/cola"); // aquí a lo que nos suscribimos. Para temas libres: /salas/chatroom etc. Para particulares /users/queue/messages
        registry.setApplicationDestinationPrefixes("/app"); //para enviar mensajes generales desde el cliente debe empezar por: /app
        registry.setUserDestinationPrefix("/usuarios"); //para recibir mensajes particulares en el cliente la suscripción debe empezar por: /users
    }
    
    @Override
    public void configureClientInboundChannel(ChannelRegistration registration) {
        registration.interceptors(new ChannelInterceptor() {
            @Override
            public Message<?> preSend(Message<?> message, MessageChannel channel) {
                StompHeaderAccessor accessor =
                        MessageHeaderAccessor.getAccessor(message, StompHeaderAccessor.class);
                System.out.println("Headers: "+ accessor);

                assert accessor != null;
                if (StompCommand.CONNECT.equals(accessor.getCommand())) {

                    String authorizationHeader = accessor.getFirstNativeHeader("Authorization");
                    assert authorizationHeader != null;
                    String token = authorizationHeader.substring(7);

                    String username = jwtService.extractUsername(token);
                    UsuarioDocument usuario = usuarioservice.findByName(username);
                    UserDetailsLogin userDetails = new UserDetailsLogin();
                    userDetails.setUsername(username);
                    userDetails.setPassword(usuario.getPassword());
                    userDetails.setRole(usuario.getRol());
               
                    UsernamePasswordAuthenticationToken usernamePasswordAuthenticationToken = new UsernamePasswordAuthenticationToken(userDetails, null, userDetails.getAuthorities());
                    SecurityContextHolder.getContext().setAuthentication(usernamePasswordAuthenticationToken);

                    accessor.setUser(usernamePasswordAuthenticationToken);
                }

                return message;
            }

        });
    }    
}