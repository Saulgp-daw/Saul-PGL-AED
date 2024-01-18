package es.iespuertodelacruz.jc.ejemplobasicoroom;

import androidx.room.ColumnInfo;
import androidx.room.Entity;
import androidx.room.PrimaryKey;

@Entity(tableName = PersonaEntity.TABLE_NAME)
public class PersonaEntity {
    public Long getId() {
        return id;
    }

    public PersonaEntity(String nombre, int edad) {
        this.nombre = nombre;
        this.edad = edad;
    }
    public PersonaEntity() {
    }
    public void setId(Long id) {
        this.id = id;
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

    public static final String TABLE_NAME = "personas";
    public static final String ID = "id";
    public static final String NOMBRE = "nombre";
    public static final String EDAD = "edad";
    @PrimaryKey(autoGenerate = true)
    @ColumnInfo(name = ID)
    public Long id;
    @ColumnInfo(name = NOMBRE)
    public String nombre;

    @ColumnInfo(name = EDAD)
    public int edad;
}