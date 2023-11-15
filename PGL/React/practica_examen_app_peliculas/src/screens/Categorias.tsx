import React from 'react'
import useObtenerCategorias from '../hooks/useObtenerCategorias'
import { Link } from 'react-router-dom';

type Props = {}

const Categorias = (props: Props) => {
  const { categorias } = useObtenerCategorias();
  return (
    <div>
      <h3>-- Lista de Categorías --</h3>
      {categorias.length > 0 ?
        (
          categorias.map(categoria => (
            <Link to={`/categorias/${categoria.nombre}`} key={categoria.id}>
              <h3>{categoria.nombre}</h3>
            </Link>
          ))
        )
        :
        (
          <h3>No hay ninguna categoria</h3>
        )

      }
    </div>
  )
}

export default Categorias