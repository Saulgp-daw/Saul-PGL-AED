package es.iespuertodelacruz.saul.room.db.entity;

import androidx.room.ColumnInfo;
import androidx.room.Entity;
import androidx.room.PrimaryKey;

@Entity(tableName = AlumnoEntity.TABLE_NAME)
public class AlumnoEntity {
    public Long getId() {
        return dni;
    }

    public AlumnoEntity(String nombre, int edad) {
        this.nombre = nombre;
        this.edad = edad;
    }
    public AlumnoEntity() {
    }
    public void setId(Long id) {
        this.dni = id;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public int getEdad() {
        return edad;
    }

    public void setEdad(int edad) {
        this.edad = edad;
    }

    public static final String TABLE_NAME = "alumnos";
    public static final String DNI = "dni";
    public static final String NOMBRE = "nombre";
    public static final String EDAD = "edad";
    @PrimaryKey
    @ColumnInfo(name = DNI)
    public Long dni;
    @ColumnInfo(name = NOMBRE)
    public String nombre;

    @ColumnInfo(name = EDAD)
    public int edad;
}