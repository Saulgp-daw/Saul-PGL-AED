package es.iespuertodelacruz.jc.graphqlfirstapp.security;

public class Usuario {
	public Usuario() {}
	String nombre;
	String password;
	String rol;
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
