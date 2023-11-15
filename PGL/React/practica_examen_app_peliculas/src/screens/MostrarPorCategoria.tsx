import React from 'react'
import { useParams } from 'react-router-dom'
import useMostrarPorCategoria from '../hooks/useMostrarPorCategoria';
import PeliculaEnCatalogo from '../components/PeliculaEnCatalogo';

type Props = {}

const MostrarPorCategoria = (props: Props) => {
  const { nombre } = useParams();
  const { pelisCategoria } = useMostrarPorCategoria(nombre);
  console.log(nombre);


  return (
    <div>
      {
        pelisCategoria.peliculas.map(pelicula => (
          <PeliculaEnCatalogo pelicula={pelicula} key={pelicula.getId()}/>
        ))
      }
    </div>
  )
}

export default MostrarPorCategoria