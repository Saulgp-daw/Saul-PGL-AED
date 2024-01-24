package es.iespuertodelacruz.jc.ejemploretrofit.data.rest;

import es.iespuertodelacruz.jc.ejemploretrofit.RESTService;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class RetrofitClient {
    private Retrofit retrofit = null;
    private static es.iespuertodelacruz.jc.ejemploretrofit.RetrofitClient instance = null;
    private es.iespuertodelacruz.jc.ejemploretrofit.RESTService restService;

    private RetrofitClient() {

        retrofit = new Retrofit.Builder()
                .baseUrl("https://dog.ceo/api/breeds/image/")
                .addConverterFactory(GsonConverterFactory.create())
                .build();
        restService = retrofit.create(es.iespuertodelacruz.jc.ejemploretrofit.RESTService.class);
    }
    public static synchronized es.iespuertodelacruz.jc.ejemploretrofit.RetrofitClient getInstance() {
        if (instance == null) {
            instance = new es.iespuertodelacruz.jc.ejemploretrofit.RetrofitClient();
        }
        return instance;
    }

    public RESTService getRestService() {
        return restService;
    }
}
