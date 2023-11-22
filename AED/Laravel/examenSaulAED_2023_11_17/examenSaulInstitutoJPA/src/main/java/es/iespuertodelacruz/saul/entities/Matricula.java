package es.iespuertodelacruz.saul.entities;

import java.io.Serializable;
import javax.persistence.*;
import java.util.List;



/**
 
The persistent class for the matriculas database table.
*/
@Entity
@Table(name="matriculas")
@NamedQuery(name="Matricula.findAll", query="SELECT m FROM Matricula m")
@NamedQuery(name="Matricula.findByIdRel", query= "SELECT m FROM Matricula m JOIN FETCH m.asignaturas WHERE m.id = :id")
public class Matricula implements Serializable {
    private static final long serialVersionUID = 1L;



    @Id
    @GeneratedValue(strategy=GenerationType.IDENTITY)
    private int id;

    private int year;





    public Matricula() {
    }


    //bi-directional many-to-one association to Alumno
    @ManyToOne
    @JoinColumn(name="dni", referencedColumnName = "dni")
    private Alumno alumno;

    @ManyToMany(mappedBy="matriculas")
    private List<Asignatura> asignaturas;

    public int getId() {
        return this.id;
    }

    public void setId(int idmatricula) {
        this.id = idmatricula;
    }

    public int getYear() {
        return this.year;
    }

    public void setYear(int year) {
        this.year = year;
    }

    public Alumno getAlumno() {
        return this.alumno;
    }

    public void setAlumno(Alumno alumno) {
        this.alumno = alumno;
    }

    public List<Asignatura> getAsignaturas() {
        return this.asignaturas;
    }

    public void setAsignaturas(List<Asignatura> asignaturas) {
        this.asignaturas = asignaturas;
    }

}