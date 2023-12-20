import React, { useState } from 'react'
import { useEffect } from 'react';
import useObtenerCategorias from './useObtenerCategorias';
import useObtenerPeliculas, { iPeliculas } from './useObtenerPeliculas';
import PeliculaEnCatalogo from '../components/PeliculaEnCatalogo';

type Props = {}

const useMostrarPorCategoria = (id: string | undefined) => {
    const { categorias } = useObtenerCategorias();
    const { arrayPeliculas } = useObtenerPeliculas();
    const [pelisCategoria, setPelisCategoria] = useState<iPeliculas>({ peliculas: [] });
    console.log(arrayPeliculas);
    
    

    useEffect(() => {
        const peliculas = {
            peliculas: arrayPeliculas.peliculas.filter(pelicula => {
                //console.log(pelicula.getCategoria());
                if(pelicula.getCategoria().some((c) => c.id == parseInt(id+"") ))
                    return pelicula;
                //return pelicula.getCategoria()[0].getNombre() == nombre?.toString();
            })
        }

        setPelisCategoria(peliculas);
        //console.log(id);
    }, [categorias, arrayPeliculas])
    return { pelisCategoria }
}

export default useMostrarPorCategoria