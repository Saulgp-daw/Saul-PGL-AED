import React, { useState } from 'react'
import usePelicula from '../hooks/usePelicula';
import { Pelicula } from '../models/Pelicula';
import PeliculaCard from '../components/PeliculaCard';
import { Link } from 'react-router-dom';
import { useAppContext } from '../contexts/PeliculasContextProvider';
import { FaRegStar, FaStar } from "react-icons/fa";
import useFavorita from '../hooks/useFavorita';
import "../styles/mostrar.css"
import useObtenerPeliculas from '../hooks/useObtenerPeliculas';
import useObtenerCategorias from '../hooks/useObtenerCategorias';
import PeliculaEnCatalogo from '../components/PeliculaEnCatalogo';

type Props = {}

interface iPeliculas {
    peliculas: Array<Pelicula>
}

const Mostrar = (props: Props) => {
    const { arrayPeliculas, setArrayPeliculas, buscador, filtrarPeliculas } = useObtenerPeliculas();
    const { categorias } = useObtenerCategorias();
    //const [buscador, setBuscador] = useState<iPeliculas>({ peliculas: [] });
    const { agregarQuitarFavorita, pelisfavoritas } = useFavorita();

    const uri: string = "http://localhost:3000/";

    return (
        <div className='vista'>
            <h2>Catálogo</h2>
            <input className="inputFiltro" type='text' onChange={(e) => filtrarPeliculas(e)} placeholder='Escriba aquí el nombre del título'></input>
            <div className="containerMiniaturas">
                {
                    buscador.peliculas.map(pelicula => (
                        <PeliculaEnCatalogo pelicula={pelicula} key={pelicula.getId()} />
                    ))
                }
            </div>
        </div>
    )
}

export default Mostrar