import axios from 'axios';
import React from 'react'
import { useNavigate } from 'react-router-dom';

type Props = {}

const useBorrarPelicula = (id: string | undefined) => {
    const ruta = "http://localhost:3000/peliculas/";
    const navigate = useNavigate();

    function borrarPelicula() {
        const axiosDelete = async (ruta: string) => {
            try {
                const response = await axios.delete(ruta + id);
                console.log(response);
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