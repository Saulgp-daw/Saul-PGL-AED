import React from 'react'
import useCrearCategoria from '../hooks/useCrearCategoria'

type Props = {}

const CrearCategoria = (props: Props) => {
    const { nuevaCategoria } = useCrearCategoria();

  return (
    <div>
        <h4>Crear una nueva categoría: </h4>
        <form onSubmit={nuevaCategoria}>
            <label htmlFor="nombre">nombre: </label><input type="text" name="nombre" placeholder='Ejm. Tragicomedia' required/>
            <button type='submit'>Crear</button>
        </form>
    </div>
  )
}

export default CrearCategoria 