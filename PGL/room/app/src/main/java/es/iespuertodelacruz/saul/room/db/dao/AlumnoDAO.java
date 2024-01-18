package es.iespuertodelacruz.saul.room.db.dao;

import androidx.room.Dao;
import androidx.room.Insert;
import androidx.room.OnConflictStrategy;
import androidx.room.Query;

import java.util.List;

import es.iespuertodelacruz.saul.room.db.entity.AlumnoEntity;

@Dao
public abstract class AlumnoDAO {

    @Insert(onConflict = OnConflictStrategy.REPLACE)
    public abstract Long insert(AlumnoEntity personaEntity);


    @Query("SELECT * FROM " + AlumnoEntity.TABLE_NAME)
    public abstract List<AlumnoEntity> getAll();
}