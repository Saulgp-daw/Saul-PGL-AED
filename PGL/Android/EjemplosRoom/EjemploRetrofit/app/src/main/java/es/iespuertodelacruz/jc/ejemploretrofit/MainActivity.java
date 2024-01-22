package es.iespuertodelacruz.jc.ejemploretrofit;

import androidx.appcompat.app.AppCompatActivity;
import androidx.lifecycle.MutableLiveData;
import androidx.lifecycle.Observer;

import android.os.Bundle;


import java.util.ArrayList;
import java.util.List;

import retrofit2.Call;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);










        MutableLiveData<PerroDTO> mutablePerros = new MutableLiveData<>();

        RESTService restService = RetrofitClient.getInstance().getRestService();
        retrofit2.Call<PerroDTO> callPerros = restService.doGetPerrosDTO();
        callPerros.enqueue(new retrofit2.Callback<PerroDTO>() {
            @Override
            public void onResponse(Call<PerroDTO> call, retrofit2.Response<PerroDTO> response) {
                if(response.isSuccessful()) {
                    PerroDTO perros = response.body();



                    mutablePerros.setValue(perros);
                }
            }

            @Override
            public void onFailure(Call<PerroDTO> call, Throwable t) {
                System.out.println("Error en la llamada");
                System.out.println(t.getMessage());
            }
        });

        //ponemos this en owner pero si esto fuera un fragment: getViewLifecycleOwner()
        mutablePerros.observe( this, perro -> {
            System.out.println("recibido  query retrofit:_____________________________ " +perro);
        });


    }
}