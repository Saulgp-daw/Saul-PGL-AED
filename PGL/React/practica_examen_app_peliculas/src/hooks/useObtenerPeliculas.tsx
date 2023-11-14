import axios from 'axios';
import React, { useEffect, useState } from 'react'
import { Pelicula } from '../models/Pelicula';

type Props = {}

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

interface iPeliculas {
    peliculas: Array<Pelicula>
}

const useObtenerPeliculas = () => {
    const ruta = "http://localhost:3000/peliculas/";
    const [arrayPeliculas, setArrayPeliculas] = useState<iPeliculas>({ peliculas: [] });
    

    useEffect(() => {
        async function recogerDatosPeliculas() {
          try {
            const response = await axios.get<iPelicula[]>(ruta);
            const peliculasGuardadas: iPeliculas = {
              peliculas: response.data.map((peliculaData: iPelicula) => {
                return new Pelicula(
                  peliculaData.id,
                  peliculaData.titulo,
                  peliculaData.direccion,
                  peliculaData.actores,
                  peliculaData.argumento,
                  peliculaData.imagen,
                  peliculaData.trailer,
                  peliculaData.categoria
                );
              }),
            };
            console.log(peliculasGuardadas);
            
            setArrayPeliculas(peliculasGuardadas);
          } catch (error) {
            console.error('Error al obtener datos de la API', error);
          }
        }
    
        //devolverUltimoId();
        recogerDatosPeliculas();
      }, []);


      return { arrayPeliculas, setArrayPeliculas }
}

export default useObtenerPeliculas