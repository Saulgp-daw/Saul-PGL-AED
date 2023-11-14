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

type Props = {}

interface iPeliculas {
    peliculas: Array<Pelicula>
}

const Mostrar = (props: Props) => {
    const { arrayPeliculas, setArrayPeliculas } = useObtenerPeliculas();
    const [buscador, setBuscador] = useState<iPeliculas>({ peliculas: [] });
    const { agregarQuitarFavorita, pelisfavoritas } = useFavorita();

    const uri: string = "http://localhost:3000/";


    function filtrarPeliculas(event: React.ChangeEvent<HTMLInputElement>){
        const nombre = event.target.value;
        const peliculasFiltradas = {peliculas : arrayPeliculas.peliculas.filter( pelicula => {
            return pelicula.getTitulo().toLowerCase().includes(nombre.toLowerCase());
        })};
        setBuscador(peliculasFiltradas);

    }

    return (
        <div>
            <h2>Catálogo</h2>
            <input type='text' onChange={(e) => filtrarPeliculas(e)} placeholder='Escriba aquí el nombre del título'></input>
            {
                buscador.peliculas.map(pelicula => (
                    <div key={pelicula.getId()}>
                        <Link to={`/pelicula/${pelicula.getId()}`} >
                            <img src={uri + pelicula.getImagen()} alt={pelicula.getTitulo()} />
                        </Link>
                        <div>
                            <h5>{pelicula.getTitulo()} &nbsp;
                            <span onClick={(e) => agregarQuitarFavorita(e, pelicula)}>
                                {pelisfavoritas.some((p) => p.getId() === pelicula.getId()) ?
                                    (
                                        <FaStar className='favourite'/>
                                    ) : (
                                        <FaRegStar />
                                    )

                                }
                            </span>
                            </h5>
                            <br />
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