package es.iespuertodelacruz.saul.room;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;

import java.util.List;

import es.iespuertodelacruz.saul.room.db.DatabaseAlumnos;
import es.iespuertodelacruz.saul.room.db.dao.AlumnoDAO;
import es.iespuertodelacruz.saul.room.db.entity.AlumnoEntity;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        DatabaseAlumnos database = DatabaseAlumnos.getDatabase(getApplicationContext());
        AlumnoDAO alumnoDAO = database.alumnoDAO();
        //personaDAO.insert(new PersonaEntity("ana",23));
        List<AlumnoEntity> alumnos = alumnoDAO.getAll();
        System.out.println("lista personas:_____________________________ " +alumnos);

    }
}