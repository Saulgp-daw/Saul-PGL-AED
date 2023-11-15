import React from 'react'
import { FaStar, FaRegStar } from 'react-icons/fa'
import { Link } from 'react-router-dom'
import { Pelicula } from '../models/Pelicula'
import useFavorita from '../hooks/useFavorita'

type Props = {
    pelicula: Pelicula
}

const PeliculaEnCatalogo = (props: Props) => {
    const pelicula = props.pelicula;
    const uri: string = "http://localhost:3000/";
    const { agregarQuitarFavorita, pelisfavoritas } = useFavorita();

    return (
        <div>
            <Link to={`/pelicula/${pelicula.getId()}`} >
                <img src={uri + pelicula.getImagen()} alt={pelicula.getTitulo()} />
            </Link>
            <div>
                <h5>{pelicula.getTitulo()} &nbsp;
                    <span onClick={(e) => agregarQuitarFavorita(e, pelicula)}>
                        {pelisfavoritas.some((p) => p.getId() === pelicula.getId()) ?
                            (
                                <FaStar className='favourite' />
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
    )
}

export default PeliculaEnCatalogo