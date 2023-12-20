import React from 'react'
import { useParams } from 'react-router-dom'
import useMostrarPorCategoria from '../hooks/useMostrarPorCategoria';
import PeliculaEnCatalogo from '../components/PeliculaEnCatalogo';
import "../styles/mostrar.css"

type Props = {}

const MostrarPorCategoria = (props: Props) => {
  const { id } = useParams();
  const { pelisCategoria } = useMostrarPorCategoria(id);
  //console.log(id);


  return (
    <div>
      <h3>Películas con categoría de {id}</h3>
      <div className="containerMiniaturas">
        {pelisCategoria.peliculas.length > 0 ? (
          pelisCategoria.peliculas.map(pelicula => (
            <PeliculaEnCatalogo pelicula={pelicula} key={pelicula.getId()} />
          ))
        ) : (
          <h5>No hay ninguna con esta categoría</h5>
        )

        }
      </div>
    </div>
  )
}

export default MostrarPorCategoria