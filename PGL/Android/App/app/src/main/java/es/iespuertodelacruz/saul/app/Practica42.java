package es.iespuertodelacruz.saul.app;

import android.os.Bundle;

import androidx.appcompat.app.AppCompatActivity;

import java.io.File;

public class Practica42 extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.practica06);

        File file = new File(getContext().getFilesDir(), "personas.csv")
    }
}