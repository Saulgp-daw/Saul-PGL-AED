package es.iespuertodelacruz.jc.ejemploretrofit.data.rest;

import es.iespuertodelacruz.jc.ejemploretrofit.data.rest.dto.AlumnoDTO;
import retrofit2.Call;
import retrofit2.http.GET;

public interface RESTService {
    @GET("alumnos")
    Call<AlumnoDTO> doGetAlumnosDTO();
}
