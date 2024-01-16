package es.iespuertodelacruz.sgp.instituto.dto;

import java.math.BigInteger;
import java.util.List;

import es.iespuertodelacruz.sgp.instituto.entities.Matricula;

public class AlumnoDTO {
	private String dni;
	private String nombre;
	private String apellidos;
	private BigInteger fechanacimiento;
	private String base64;
	private String imagen;
	//private List<Matricula> matriculas;


	public AlumnoDTO() {
		super();
	}
	public AlumnoDTO(String dni, String nombre, String apellidos, BigInteger fechanacimiento, String base64,
			String imagen) {
		super();
		this.dni = dni;
		this.nombre = nombre;
		this.apellidos = apellidos;
		this.fechanacimiento = fechanacimiento;
		this.base64 = base64;
		this.imagen = imagen;
		//this.matriculas = matriculas;
	}
	public String getDni() {
		return dni;
	}
	public void setDni(String dni) {
		this.dni = dni;
	}
	public String getNombre() {
		return nombre;
	}
	public void setNombre(String nombre) {
		this.nombre = nombre;
	}
	public String getApellidos() {
		return apellidos;
	}
	public void setApellidos(String apellidos) {
		this.apellidos = apellidos;
	}
	public BigInteger getFechanacimiento() {
		return fechanacimiento;
	}
	public void setFechanacimiento(BigInteger fechanacimiento) {
		this.fechanacimiento = fechanacimiento;
	}
	public String getBase64() {
		return base64;
	}
	public void setBase64(String base64) {
		this.base64 = base64;
	}
	public String getImagen() {
		return imagen;
	}
	public void setImagen(String imagen) {
		this.imagen = imagen;
	}
	/*
	public List<Matricula> getMatriculas() {
		return matriculas;
	}
	public void setMatriculas(List<Matricula> matriculas) {
		this.matriculas = matriculas;
	}*/
	
	


	
}
