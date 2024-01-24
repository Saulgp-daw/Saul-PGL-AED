package es.iespuertodelacruz.jc.ejemplowebsocketseguro.document;

import org.springframework.data.annotation.Id;
import org.springframework.data.mongodb.core.mapping.Document;

@Document
public class UsuarioDocument {
	@Id
	String id;
	String nombre;
	String password;
	String rol;	
	public String getId() {
		return id;
	}
	public void setId(String id) {
		this.id = id;
	}
;	
	public UsuarioDocument() {
		super();
	}
	public String getNombre() {
		return nombre;
	}
	public void setNombre(String nombre) {
		this.nombre = nombre;
	}
	public String getPassword() {
		return password;
	}
	public void setPassword(String password) {
		this.password = password;
	}
	public String getRol() {
		return rol;
	}
	public void setRol(String rol) {
		this.rol = rol;
	}


}
