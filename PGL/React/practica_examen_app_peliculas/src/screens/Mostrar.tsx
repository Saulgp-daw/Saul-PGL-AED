import React from 'react'
import usePelicula from '../hooks/usePelicula';
import { Pelicula } from '../models/Pelicula';
import PeliculaCard from '../components/PeliculaCard';
import { Link } from 'react-router-dom';
import { useAppContext } from '../contexts/PeliculasContextProvider';
import { AiOutlineStar } from "react-icons/ai";
import useFavorita from '../hooks/useFavorita';
import "../styles/mostrar.css"

type Props = {}

const Mostrar = (props: Props) => {
    const { arrayPeliculas } = usePelicula();
    const { agregarQuitarFavorita } = useFavorita();

    const uri: string = "http://localhost:3000/";
    console.log(arrayPeliculas);

    

    return (
        <div>
            <h2>Catálogo</h2>
            {
                arrayPeliculas.peliculas.map(pelicula => (
                    <div key={pelicula.getId()}>
                        <Link to={`/pelicula/${pelicula.getId()}`} >
                            <img src={uri + pelicula.getImagen()} alt={pelicula.getTitulo()} />
                        </Link>
                        <div>
                            <h5>{pelicula.getTitulo()}</h5><div onClick={() => agregarQuitarFavorita(pelicula)}><AiOutlineStar className='unfavourite'/></div><br />
                            <span>{pelicula.getDireccion()}</span><br />
                            <span>{pelicula.getActores()}</span><br />
                            <span>{pelicula.getCategoria()}</span><br />
                            <span>{pelicula.getArgumento()}</span><br />

                        </div>
                    </div>

                ))
            }
        </div>
    )
}

export default Mostrar