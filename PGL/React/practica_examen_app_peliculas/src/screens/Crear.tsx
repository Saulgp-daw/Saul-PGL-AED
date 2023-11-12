import React from 'react'
import usePelicula from '../hooks/usePelicula'

type Props = {}

const Crear = (props: Props) => {
  const { agregarPelicula } = usePelicula();

  return (
    <div>
      <h3>Añadir Pelicula</h3>
      <form onSubmit={agregarPelicula}>
        <label htmlFor="titulo">Titulo: </label><input type="text" name='titulo' required/><br />
        <label htmlFor="direccion">Dirección: </label><input type="text" name='direccion' required/><br />
        <label htmlFor="actores">Actores: </label><input type="text" name='actores' required/><br />
        <label htmlFor="argumento">Argumento: </label><input type="text" name='argumento' required/><br />
        <label htmlFor="imagen">Imagen: </label><input type="text" name='imagen'/><br />
        <label htmlFor="trailer">Trailer: </label><input type="text" name='trailer'/><br />
        <label htmlFor="categoria">Categoria: </label><input type="text" name='categoria'/><br />
        <button type='submit'>Añadir</button>
      </form>
    </div>
  )
}

export default Crear