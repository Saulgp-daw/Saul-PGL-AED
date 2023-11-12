import React from 'react'
import usePelicula from '../hooks/usePelicula';
import { Pelicula } from '../models/Pelicula';
import PeliculaCard from '../components/PeliculaCard';
import { Link } from 'react-router-dom';

type Props = {}

const Mostrar = (props: Props) => {
    const { arrayPeliculas } = usePelicula();
    const uri: string = "http://localhost:3000/";
    console.log(arrayPeliculas);

    return (
        <div>
            <h2>Catálogo</h2>
            {
                arrayPeliculas.peliculas.map(pelicula => (
                    <Link to={`/pelicula/${pelicula.getId()}`} key={pelicula.getId()}>
                        <div>
                            <img src={uri + pelicula.getImagen()} alt={pelicula.getTitulo()} />
                            <div>
                                <h5>{pelicula.getTitulo()}</h5><br />
                                <span>{pelicula.getDireccion()}</span><br />
                                <span>{pelicula.getActores()}</span><br />
                                <span>{pelicula.getCategoria()}</span><br />
                                <span>{pelicula.getArgumento()}</span><br />

                            </div>
                        </div>
                    </Link>
                ))
            }
        </div>
    )
}

export default Mostrar