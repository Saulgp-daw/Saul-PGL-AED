import axios from 'axios';
import React from 'react'
import { useNavigate } from 'react-router-dom';
import useFavorita from './useFavorita';

type Props = {}

const useBorrarPelicula = (id: string | undefined) => {
    const ruta = "http://localhost:3000/peliculas/";
    const navigate = useNavigate();
    const { actualizarFavoritoSiSeBorra } = useFavorita();

    function borrarPelicula() {
        const axiosDelete = async (ruta: string) => {
            try {
                const response = await axios.delete(ruta + id);
                console.log(response);
                actualizarFavoritoSiSeBorra(id);
                navigate("/");
            } catch (error) {
                console.log(error);
            }
        }
        axiosDelete(ruta);
    }

    return { borrarPelicula }
}

export default useBorrarPelicula