package es.iespuertodelacruz.jc.ejemplobasicoroom;

import androidx.room.Dao;
import androidx.room.Insert;
import androidx.room.OnConflictStrategy;
import androidx.room.Query;

import java.util.List;

@Dao
public abstract class PersonaDAO {

    @Insert(onConflict = OnConflictStrategy.REPLACE)
    public abstract Long insert(PersonaEntity personaEntity);


    @Query("SELECT * FROM " + PersonaEntity.TABLE_NAME)
    public abstract List<PersonaEntity> getAll();
}
