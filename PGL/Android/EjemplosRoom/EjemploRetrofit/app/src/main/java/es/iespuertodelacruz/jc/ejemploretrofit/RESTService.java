package es.iespuertodelacruz.jc.ejemploretrofit;

import java.util.List;

import retrofit2.Call;
import retrofit2.http.GET;

public interface RESTService {
    @GET("random")
    Call<PerroDTO> doGetPerrosDTO();
}
