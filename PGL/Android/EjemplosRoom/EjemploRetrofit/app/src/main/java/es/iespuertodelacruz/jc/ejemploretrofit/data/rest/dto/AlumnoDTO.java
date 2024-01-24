package es.iespuertodelacruz.jc.ejemploretrofit.data.rest.dto;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;
public class AlumnoDTO {
    @SerializedName("dni")
    @Expose
    private String dni;
    @SerializedName("apellidos")
    @Expose
    private String apellidos;
    @SerializedName("fechanacimiento")
    @Expose
    private Long fechanacimiento;
    @SerializedName("nombre")
    @Expose
    private String nombre;
    @SerializedName("imagen")
    @Expose
    private String imagen;


    public String getDni() {
        return dni;
    }

    public void setDni(String dni) {
        this.dni = dni;
    }

    public String getApellidos() {
        return apellidos;
    }

    public void setApellidos(String apellidos) {
        this.apellidos = apellidos;
    }

    public Long getFechanacimiento() {
        return fechanacimiento;
    }

    public void setFechanacimiento(Long fechanacimiento) {
        this.fechanacimiento = fechanacimiento;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public String getImagen() {
        return imagen;
    }

    public void setImagen(String imagen) {
        this.imagen = imagen;
    }



}

