import React from 'react'
import { useAppContext } from '../contexts/PeliculasContextProvider'

type Props = {}

const PeliculasFavoritas = (props: Props) => {
  const { pelisfavoritas, setpelisfavoritas } = useAppContext();
  const uri: string = "http://localhost:3000/";
  console.log(pelisfavoritas);



  return (
    <div>
      <h4>Películas favoritas</h4>
      <div style={{ display: "flex" }}>
        {
          pelisfavoritas.map(pelicula => (
            <div style={{ display: "flex", width: "160px" }} key={pelicula.getId()}>
              <img src={uri + pelicula.getImagen()} alt={pelicula.getTitulo()} height="100px" />
              <h4>{pelicula.getTitulo()}</h4>
            </div>
          ))
        }
      </div>
    </div>
  )
}

export default PeliculasFavoritas