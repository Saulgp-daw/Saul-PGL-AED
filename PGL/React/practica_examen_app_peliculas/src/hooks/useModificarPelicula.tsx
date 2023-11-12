import axios from 'axios';
import React from 'react'
import { useNavigate } from 'react-router-dom';

type Props = {}

const useModificarPelicula = () => {
    const ruta = "http://localhost:3000/peliculas/";
    const navigate = useNavigate();

    function modificarPelicula(event: React.FormEvent<HTMLFormElement>){
        event.preventDefault();
        let formulario: HTMLFormElement = event.currentTarget;
        let id: string = formulario.idPelicula.value;
        let titulo: string = formulario.titulo.value;
        let direccion: string = formulario.direccion.value;
        let actores: string = formulario.actores.value;
        let argumento: string = formulario.argumento.value;
        let imagen: string = formulario.imagen.value;
        let trailer: string = formulario.trailer.value;
        let categoria: string = formulario.categoria.value;

        const peliModificada = {
            "id" : id,
            "titulo": titulo,
            "direccion": direccion,
            "actores": actores,
            "argumento": argumento,
            "imagen": imagen,
            "trailer": trailer,
            "categoria": categoria
        }

        const axiosPut = async (ruta: string) => {
            try {
                const response = await axios.put(ruta+id, peliModificada)
                console.log(response.data);
                console.log(response.status);
                navigate("/");
            } catch (error) {
                console.log(error);
            }
        }
        axiosPut(ruta);


    }

  return { modificarPelicula }
}

export default useModificarPelicula