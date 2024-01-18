package es.iespuertodelacruz.saul.room.db;

import android.content.Context;

import androidx.room.Room;

import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;

import es.iespuertodelacruz.saul.room.db.dao.AlumnoDAO;
import es.iespuertodelacruz.saul.room.db.entity.AlumnoEntity;

@androidx.room.Database(
        entities = {
                AlumnoEntity.class,
//HistoricoEntity.class
        }, version = 1
        , exportSchema = false
)
public abstract class DatabaseAlumnos extends androidx.room.RoomDatabase{
    abstract public AlumnoDAO alumnoDAO();
    //abstract public HistoricoDAO historicoDAO();
    private static volatile DatabaseAlumnos INSTANCE;
    private static final int NUMBER_OF_THREADS = 4;
    static final ExecutorService databaseWriteExecutor =
            Executors.newFixedThreadPool(NUMBER_OF_THREADS);
    public static DatabaseAlumnos getDatabase(final Context context) {
        if (INSTANCE == null) {
            synchronized (DatabaseAlumnos.class) {
                if (INSTANCE == null) {
                    INSTANCE = Room.databaseBuilder(context.getApplicationContext(),
                                    DatabaseAlumnos.class, "personas.db")
                            .allowMainThreadQueries()
                            .fallbackToDestructiveMigration()
                            .build();
                }
            }
        }
        return INSTANCE;
    }
}