import React from 'react'
import { FaStar, FaRegStar } from 'react-icons/fa'
import { Link } from 'react-router-dom'
import { Pelicula } from '../models/Pelicula'
import useFavorita from '../hooks/useFavorita'

//css
import "../styles/peliculaencatalogo.css";

type Props = {
    pelicula: Pelicula
}

const PeliculaEnCatalogo = (props: Props) => {
    const pelicula = props.pelicula;
    const uri: string = "http://localhost:8080/api/peliculas/ficheros/";
    const { agregarQuitarFavorita, pelisfavoritas } = useFavorita();

    return (
        <div className='miniaturaPelicula'>
            <Link to={`/pelicula/${pelicula.getId()}`} className='enlace'>
                <img src={uri + pelicula.getImagen()} alt={pelicula.getTitulo()} className='imgCatalogo' />
            </Link>
            <div>
                <h3 className='titulo'>{pelicula.getTitulo()} &nbsp;
                    <span onClick={(e) => agregarQuitarFavorita(e, pelicula)}>
                        {pelisfavoritas.some((p) => p.getId() === pelicula.getId()) ?
                            (
                                <FaStar className='favourite icon' />
                            ) : (
                                <FaRegStar className='icon' />
                            )

                        }
                    </span>
                </h3>
                <br />
                <span><span className="tipo">Dirección:</span> {pelicula.getDireccion()}</span><br />
                <span><span className="tipo">Reparto:</span> {pelicula.getActores()}</span><br />
                <span><span className="tipo">Categoría: </span>{pelicula.getCategoriasComoString()}</span><br />
                <span><span className='tipo'>Sinopsis:</span> {pelicula.getArgumento()}</span><br />

            </div>
        </div>
    )
}

export default PeliculaEnCatalogo