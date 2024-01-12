import axios from 'axios';
import React from 'react'
import { useNavigate } from 'react-router-dom';
import useFavorita from './useFavorita';
import { useAppContext } from '../contexts/PeliculasContextProvider';

type Props = {}

const useBorrarPelicula = (id: string | undefined) => {
    const ruta = "http://localhost:8080/api/v3/peliculas/";
    const navigate = useNavigate();
    const { actualizarFavoritoSiSeBorra } = useFavorita();
    const { token } = useAppContext();
    console.log(token);

    function borrarPelicula() {
        const axiosDelete = async (ruta: string) => {
            try {
                const response = await axios.delete(ruta + id, { headers: { 'Authorization': `Bearer ${token}` } });
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