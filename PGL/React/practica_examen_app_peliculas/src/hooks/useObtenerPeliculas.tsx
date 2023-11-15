import axios from 'axios';
import React, { useEffect, useState } from 'react'
import { Pelicula } from '../models/Pelicula';
import useObtenerCategorias from './useObtenerCategorias';

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

export interface iPeliculas {
    peliculas: Array<Pelicula>
}

const useObtenerPeliculas = () => {
    const ruta = "http://localhost:3000/peliculas/";
    const [arrayPeliculas, setArrayPeliculas] = useState<iPeliculas>({ peliculas: [] });
    const [buscador, setBuscador] = useState<iPeliculas>({ peliculas: [] });
    const { categorias } = useObtenerCategorias();
    
    function filtrarPeliculas(event: React.ChangeEvent<HTMLInputElement>){
      const nombre = event.target.value;
      const peliculasFiltradas = {peliculas : arrayPeliculas.peliculas.filter( pelicula => {
          return pelicula.getTitulo().toLowerCase().includes(nombre.toLowerCase());
      })};
      setBuscador(peliculasFiltradas);

  }
    

    useEffect(() => {
      console.log("--categorias cargadas--");
      
      
        async function recogerDatosPeliculas() {
          try {
            const response = await axios.get<iPelicula[]>(ruta);
            const peliculasGuardadas: iPeliculas = {
              peliculas: response.data.map((peliculaData: iPelicula) => {
                const nombreCategoria = categorias.find( categoria => categoria.id.toString() == peliculaData.categoria)?.nombre || '';
                return new Pelicula(
                  peliculaData.id,
                  peliculaData.titulo,
                  peliculaData.direccion,
                  peliculaData.actores,
                  peliculaData.argumento,
                  peliculaData.imagen,
                  peliculaData.trailer,
                  nombreCategoria
                );
              })
            };
            console.log(peliculasGuardadas);
            
            setArrayPeliculas(peliculasGuardadas);
            setBuscador(peliculasGuardadas);
          } catch (error) {
            console.error('Error al obtener datos de la API', error);
          }
        }
    
        //devolverUltimoId();
        recogerDatosPeliculas();
      }, [categorias]);


      return { arrayPeliculas, buscador, setArrayPeliculas, filtrarPeliculas }
}

export default useObtenerPeliculas