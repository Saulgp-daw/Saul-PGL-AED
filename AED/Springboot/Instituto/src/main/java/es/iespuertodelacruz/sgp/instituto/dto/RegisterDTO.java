package es.iespuertodelacruz.sgp.instituto.dto;

public class RegisterDTO {
	private String nombre;
	private String password;
	private String email;
	
	
	public RegisterDTO(String nombre, String password, String rol, boolean active, String hash, String email) {
		super();
		this.nombre = nombre;
		this.password = password;
		
		this.email = email;
	}

	public String getUsername() {
		return nombre;
	}

	public void setUsername(String username) {
		this.nombre = username;
	}

	public String getPassword() {
		return password;
	}

	public void setPassword(String password) {
		this.password = password;
	}
	
	
	
	public String getEmail() {
		return this.email;
	}
	
	public void setEmail(String email) {
		this.email = email;
	}

	
	
	
	
	
}
