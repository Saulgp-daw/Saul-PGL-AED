package es.iespuertodelacruz.jc.ejemplobasicoroom;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;

import java.util.List;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        DatabasePersonas database = DatabasePersonas.getDatabase(getApplicationContext());
        PersonaDAO personaDAO = database.personaDAO();
        //personaDAO.insert(new PersonaEntity("ana",23));
        List<PersonaEntity> personas = personaDAO.getAll();
        System.out.println("lista personas:_____________________________ " +personas);

    }
}