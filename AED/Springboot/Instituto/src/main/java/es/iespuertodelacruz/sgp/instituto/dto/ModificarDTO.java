package es.iespuertodelacruz.sgp.instituto.dto;

public class ModificarDTO {

	private String email;
	private String password;
	private String passwordAntigua;
	
	public String getPasswordAntigua() {
		return passwordAntigua;
	}

	public void setPasswordAntigua(String passwordAntigua) {
		this.passwordAntigua = passwordAntigua;
	}

	public String getEmail() {
		return email;
	}

	public void setEmail(String email) {
		this.email = email;
	}

	public String getPassword() {
		return password;
	}

	public void setPassword(String password) {
		this.password = password;
	}

	public ModificarDTO(String email, String password) {
		super();
		this.email = email;
		this.password = password;
	}
	
	
}
