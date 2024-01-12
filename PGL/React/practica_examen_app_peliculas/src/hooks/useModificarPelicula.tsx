import axios from 'axios';
import React, { useState } from 'react'
import { useNavigate } from 'react-router-dom';
import usePelicula, { iPelicula } from './usePelicula';
import { Categoria } from '../models/Categoria';
import { useAppContext } from '../contexts/PeliculasContextProvider';

type Props = {}

const useModificarPelicula = () => {
    const ruta = "http://localhost:8080/api/v2/peliculas/";
    const navigate = useNavigate();
    const [categoriasPeli, setCategoriasPeli] = useState<Categoria[]>([]);
    const { token } = useAppContext();
    console.log(token);

    function agregarQuitarCategoria(cat: Categoria) {

        if (!categoriasPeli.some((p) => p.id === cat.getId())) {
            setCategoriasPeli([...categoriasPeli, cat]);
        } else {
            const nuevoArray = categoriasPeli.filter((p) => p.id !== cat.getId());
            setCategoriasPeli(nuevoArray);
        }

        console.log(categoriasPeli);
    }

    function modificarPelicula(event: React.FormEvent<HTMLFormElement>) {
        event.preventDefault();
        let formulario: HTMLFormElement = event.currentTarget;
        let id: number = parseInt(formulario.idPelicula.value);
        let titulo: string = formulario.titulo.value;
        let direccion: string = formulario.direccion.value;
        let actores: string = formulario.actores.value;
        let argumento: string = formulario.argumento.value;
        let nombreFichero: string = formulario.imagen.value;
        let trailer: string = formulario.trailer.value;
        console.log(categoriasPeli);


        // const peliModificada = {
        //     "id" : id,
        //     "titulo": titulo,
        //     "direccion": direccion,
        //     "actores": actores,
        //     "argumento": argumento,
        //     "imagen": nombreFichero,
        //     "trailer": trailer,
        //     "categoria": categoria
        // }

        const peliculaModificada: iPelicula = {
            id: id,
            titulo: titulo,
            actores: actores,
            argumento: argumento,
            direccion: direccion,
            trailer: trailer,
            imagen: nombreFichero,
            categorias: categoriasPeli,

        }

        console.log(peliculaModificada);


        const axiosPut = async (ruta: string) => {
            try {
                const response = await axios.put(ruta + id, peliculaModificada, { headers: { 'Authorization': `Bearer ${token}` } })
                console.log(response.data);
                console.log(response.status);
                navigate("/");
            } catch (error) {
                console.log(error);
            }
        }
        axiosPut(ruta);


    }

    return { modificarPelicula, agregarQuitarCategoria, setCategoriasPeli, categoriasPeli }
}

export default useModificarPelicula