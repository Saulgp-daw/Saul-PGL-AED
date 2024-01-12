import React from 'react'
import { useAppContext } from '../contexts/PeliculasContextProvider'
import { Link } from 'react-router-dom';
import "../styles/favoritas.css"

type Props = {}

const PeliculasFavoritas = (props: Props) => {
  const { pelisfavoritas, setpelisfavoritas } = useAppContext();
  const uri: string = "http://localhost:8080/api/v1/peliculas/ficheros/";
  console.log(pelisfavoritas);



  return (
    <div>
      <h4>Películas favoritas</h4>
      <div className='vistaFavoritas'>
        {pelisfavoritas.length > 0 ? (
          pelisfavoritas.map(pelicula => (
            <Link className='enlacePeli' to={`/pelicula/${pelicula.getId()}`} key={pelicula.getId()} >
              <div className='fichaFavorita' >
                <img src={uri + pelicula.getImagen()} alt={pelicula.getTitulo()} height="100px" />
                <h4>{pelicula.getTitulo()}</h4>
              </div>
            </Link>
          ))
        ) :
          (
            <p>No hay favoritas asignadas</p>
          )
        }
      </div>
    </div>
  )
}

export default PeliculasFavoritas