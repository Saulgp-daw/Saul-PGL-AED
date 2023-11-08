package es.iespuertodelacruz.monedas.entities;

import java.io.Serializable;
import javax.persistence.*;


/**
 * The persistent class for the usuario_rol database table.
 * 
 */
@Entity
@Table(name="usuario_rol")
@NamedQuery(name="UsuarioRol.findAll", query="SELECT u FROM UsuarioRol u")
public class UsuarioRol implements Serializable {
	private static final long serialVersionUID = 1L;

	@Id
	@GeneratedValue(strategy=GenerationType.IDENTITY)
	@Column(name="idusuario_rol", unique=true, nullable=false)
	private int idusuarioRol;

	//bi-directional many-to-one association to Rol
	@ManyToOne
	@JoinColumn(name="fk_rol", nullable=false)
	private Rol rol;

	//bi-directional many-to-one association to Usuario
	@ManyToOne
	@JoinColumn(name="fk_usuario", nullable=false)
	private Usuario usuario;

	public UsuarioRol() {
	}

	public int getIdusuarioRol() {
		return this.idusuarioRol;
	}

	public void setIdusuarioRol(int idusuarioRol) {
		this.idusuarioRol = idusuarioRol;
	}

	public Rol getRol() {
		return this.rol;
	}

	public void setRol(Rol rol) {
		this.rol = rol;
	}

	public Usuario getUsuario() {
		return this.usuario;
	}

	public void setUsuario(Usuario usuario) {
		this.usuario = usuario;
	}

}