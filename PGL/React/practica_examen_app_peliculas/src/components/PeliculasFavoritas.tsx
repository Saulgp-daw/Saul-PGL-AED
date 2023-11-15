import React from 'react'
import { useAppContext } from '../contexts/PeliculasContextProvider'
import { Link } from 'react-router-dom';

type Props = {}

const PeliculasFavoritas = (props: Props) => {
  const { pelisfavoritas, setpelisfavoritas } = useAppContext();
  const uri: string = "http://localhost:3000/";
  console.log(pelisfavoritas);



  return (
    <div>
      <h4>Películas favoritas</h4>
      <div style={{ display: "flex" }}>
        {pelisfavoritas.length > 0 ? (
          pelisfavoritas.map(pelicula => (
            <Link to={`/pelicula/${pelicula.getId()}`} key={pelicula.getId()} >
              <div style={{ display: "flex", width: "160px" }} >
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