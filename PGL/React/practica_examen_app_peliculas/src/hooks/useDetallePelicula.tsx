import axios from 'axios';
import React, { useEffect, useState } from 'react'
import { Pelicula } from '../models/Pelicula';
import { useParams } from 'react-router-dom';

type Props = {
    id: string
}

interface iPelicula {
    id: string,
    titulo: string,
    direccion: string,
    actores: string,
    argumento: string,
    imagen: string,
    trailer: string,
    categoria: string
}

const useDetallePelicula = (id: string | undefined) => {
    const ruta = "http://localhost:3000/peliculas/";
    const [pelicula, setPelicula] = useState<Pelicula>();

    useEffect(() => {
        async function recogerDatos() {
            try {
                const response = await axios.get<iPelicula>(ruta + id);
                console.log(response);
                const peliculaNueva: Pelicula = convertirAObjetoPelicula(response.data);
                console.log(peliculaNueva);
                setPelicula(peliculaNueva);
            } catch (error) {
                console.error('Error al obtener datos de la API', error);
            }
        }
        recogerDatos();
    }, []);

    function convertirAObjetoPelicula(apiResponse: iPelicula): Pelicula{
        return new Pelicula(
            apiResponse.id,
            apiResponse.titulo,
            apiResponse.direccion,
            apiResponse.actores,
            apiResponse.argumento,
            apiResponse.imagen,
            apiResponse.trailer,
            apiResponse.categoria
        );
    }


    return {pelicula}
}

export default useDetallePelicula