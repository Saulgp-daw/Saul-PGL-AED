package es.iespuertodelacruz.jc.ejemplobasicoroom;


import android.content.Context;

import androidx.room.Room;

import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;

@androidx.room.Database(
        entities = {
PersonaEntity.class,
//HistoricoEntity.class
        }, version = 1
        , exportSchema = false
)
public abstract class DatabasePersonas extends androidx.room.RoomDatabase{
    abstract public PersonaDAO personaDAO();
//abstract public HistoricoDAO historicoDAO();
    private static volatile DatabasePersonas INSTANCE;
    private static final int NUMBER_OF_THREADS = 4;
    static final ExecutorService databaseWriteExecutor =
            Executors.newFixedThreadPool(NUMBER_OF_THREADS);
    public static DatabasePersonas getDatabase(final Context context) {
        if (INSTANCE == null) {
            synchronized (DatabasePersonas.class) {
                if (INSTANCE == null) {
                    INSTANCE = Room.databaseBuilder(context.getApplicationContext(),
                                    DatabasePersonas.class, "personas.db")
.allowMainThreadQueries()
                            .fallbackToDestructiveMigration()
                            .build();
                }
            }
        }
        return INSTANCE;
    }
}
