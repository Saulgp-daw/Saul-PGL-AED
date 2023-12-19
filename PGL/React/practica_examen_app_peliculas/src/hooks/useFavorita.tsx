import React from 'react'
import { useAppContext } from '../contexts/PeliculasContextProvider';
import { Pelicula } from '../models/Pelicula';

type Props = {}

const useFavorita = () => {
    const { pelisfavoritas, setpelisfavoritas } = useAppContext();

    const agregarQuitarFavorita = (e: any, pelicula: Pelicula) => {
        e.preventDefault();

        if (!pelisfavoritas.some((p) => p.getId() === pelicula.getId())) {
            setpelisfavoritas([...pelisfavoritas, pelicula]);
        } else {
            const nuevoArray = pelisfavoritas.filter((p) => p.getId() !== pelicula.getId());
            setpelisfavoritas(nuevoArray);
        }


        console.log(pelisfavoritas);

    }

    function actualizarFavoritoSiSeBorra(id: string | undefined) {
        const nuevoArray = pelisfavoritas.filter((p) => p.getId() !== parseInt(id + ""));
        setpelisfavoritas(nuevoArray);
    }
    return { actualizarFavoritoSiSeBorra, agregarQuitarFavorita, pelisfavoritas }
}

export default useFavorita