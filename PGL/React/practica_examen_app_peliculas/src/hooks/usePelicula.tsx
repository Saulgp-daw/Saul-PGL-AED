import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { Pelicula } from '../models/Pelicula'
import { useNavigate } from 'react-router-dom';
import useObtenerPeliculas from './useObtenerPeliculas';
import { Categoria } from '../models/Categoria';
import { iCategoria } from './useObtenerCategorias';

type Props = {}

interface iPelicula {
    titulo: string,
    actores: string,
    argumento: string,
    direccion: string,
    trailer: string,
    fotoBase64: string,
    nombreFichero: string,
    categorias: Categoria[]
}

interface iPeliculas {
    peliculas: Array<Pelicula>
}

const usePelicula = () => {
    const ruta = "http://localhost:8080/api/peliculas/base64";
    // const [arrayPeliculas, setArrayPeliculas] = useState<iPeliculas>({ peliculas: [] });
    const navigate = useNavigate();
    const { arrayPeliculas } = useObtenerPeliculas();
    const [categorias, setCategorias] = useState<Categoria[]>([]);
    const [nombrefichero, setnombrefichero] = useState("");
    const [photoBase64, setphotoBase64] = useState("");

    function agregarQuitarCategoria(cat: Categoria) {

        if (!categorias.some((p) => p.getId() === cat.getId())) {
            setCategorias([...categorias, cat]);
        } else {
            const nuevoArray = categorias.filter((p) => p.getId() !== cat.getId());
            setCategorias(nuevoArray);
        }

        //console.log(categorias);



    }

    // function devolverUltimoId() {
    //     if (arrayPeliculas.peliculas.length > 0) {
    //         let ultimoId: string = parseInt(arrayPeliculas.peliculas[arrayPeliculas.peliculas.length - 1].getId()) + 1 + "";
    //         //console.log(ultimoId);
    //         if (ultimoId.length == 1) {
    //             ultimoId = "00" + ultimoId;
    //         } else if (ultimoId.length == 2) {
    //             ultimoId = "0" + ultimoId;
    //         }
    //         //console.log(ultimoId);  
    //         return ultimoId;
    //     }

    //     return null;
    // }

    function agregarPelicula(event: React.FormEvent<HTMLFormElement>) {
        event.preventDefault();
        let formulario: HTMLFormElement = event.currentTarget;
        let titulo: string = formulario.titulo.value;
        let direccion: string = formulario.direccion.value;
        let actores: string = formulario.actores.value;
        let argumento: string = formulario.argumento.value;
        let trailer: string = formulario.trailer.value ?? "https://www.youtube.com/watch?v=dQw4w9WgXcQ";
        let dataBase64 = photoBase64;
        dataBase64 = dataBase64.replace(/^.*base64,/, "");


        const nuevaPeli: iPelicula = {
            titulo: titulo,
            actores: actores,
            argumento: argumento,
            direccion: direccion,
            trailer: trailer,
            fotoBase64: dataBase64,
            nombreFichero: nombrefichero,
            categorias: categorias
        }


        const axiospost = async () => {
            try {
                const response = await axios.post(ruta, nuevaPeli);
                console.log(response.data);
                navigate("/");
            } catch (error) {
                console.log(error);
            }
        }
        axiospost();
    }



    return { agregarPelicula, agregarQuitarCategoria, setnombrefichero, setphotoBase64 }
}

export default usePelicula