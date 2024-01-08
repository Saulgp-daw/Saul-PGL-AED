package es.iespuertodelacruz.saul.app;

import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;

import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

public class MainActivity extends AppCompatActivity {

    /*@Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
    }*/

    /*@Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        Toast.makeText(getApplicationContext(), "First onCreate() calls", Toast.LENGTH_SHORT).show();
    }*/

    int contador = 0;
       @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
           View btnPrueba = findViewById(R.id.btnPulsar);
           btnPrueba.setOnClickListener(new View.OnClickListener() {
            Fragment f = null;
            @Override
            public void onClick(View v) {
                contador++;
                if(contador % 2 == 0){
                    f = new BlankFragmentUno();
                }else{
                    f = new BlankFragmentDos();
                }
                getSupportFragmentManager()
                        .beginTransaction()
                        .replace(R.id.fragmentContainerView, f)
                        .commit();
            }
        });
    }
}
}