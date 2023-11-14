import React from 'react'
import { useAppContext } from '../contexts/PeliculasContextProvider';
import { Pelicula } from '../models/Pelicula';

type Props = {}

const useFavorita = () => {
    const { pelisfavoritas, setpelisfavoritas } = useAppContext();
    
    function agregarQuitarFavorita(pelicula: Pelicula) {
        if (!pelisfavoritas.some((p) => p.getId() === pelicula.getId())) {
            setpelisfavoritas([...pelisfavoritas, pelicula]);
        }else{
            const nuevoArray = pelisfavoritas.filter((p) => p.getId() !== pelicula.getId());
            setpelisfavoritas(nuevoArray);
        }
        

        console.log(pelisfavoritas);

    }
  return {agregarQuitarFavorita}
}

export default useFavorita