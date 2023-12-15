import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { Pelicula } from '../models/Pelicula'
import { useNavigate } from 'react-router-dom';
import useObtenerPeliculas from './useObtenerPeliculas';

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

const usePelicula = () => {
    const ruta = "http://localhost:8080/api/peliculas/base64";
    // const [arrayPeliculas, setArrayPeliculas] = useState<iPeliculas>({ peliculas: [] });
    const navigate = useNavigate();
    const { arrayPeliculas } = useObtenerPeliculas();

    function devolverUltimoId() {
        if (arrayPeliculas.peliculas.length > 0) {
            let ultimoId: string = parseInt(arrayPeliculas.peliculas[arrayPeliculas.peliculas.length - 1].getId()) + 1 + "";
            //console.log(ultimoId);
            if (ultimoId.length == 1) {
                ultimoId = "00" + ultimoId;
            } else if (ultimoId.length == 2) {
                ultimoId = "0" + ultimoId;
            }
            //console.log(ultimoId);  
            return ultimoId;
        }

        return null;
    }

    function agregarPelicula(event: React.FormEvent<HTMLFormElement>) {
        event.preventDefault();
        let formulario: HTMLFormElement = event.currentTarget;
        let titulo: string = formulario.titulo.value;
        let direccion: string = formulario.direccion.value;
        let actores: string = formulario.actores.value;
        let argumento: string = formulario.argumento.value;
        let imagen: string = formulario.imagen.value ?? "default.gif";
        if (imagen.trim() === "") {
            imagen = "default.gif";
        }
        let trailer: string = formulario.trailer.value ?? "https://www.youtube.com/watch?v=dQw4w9WgXcQ";
        let categoria: string = formulario.categoria.value ?? "";

        const nuevaPelicula = {
            "id": devolverUltimoId(),
            "titulo": titulo,
            "direccion": direccion,
            "actores": actores,
            "argumento": argumento,
            "imagen": imagen,
            "trailer": trailer,
            "categoria": categoria
        }

        console.log(nuevaPelicula);


        const axiospost = async () => {
            try {
                const response = await axios.post(ruta, nuevaPelicula);
                console.log(response.data);
                navigate("/");
            } catch (error) {
                console.log(error);
            }
        }
        axiospost();
    }



    return { agregarPelicula }
}

export default usePelicula