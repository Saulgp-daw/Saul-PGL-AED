import React from 'react'

type Props = {
    fechaActual: Date
}

const Fecha = (props: Props) => {
  return (
    <div><h5>Fecha: </h5>
    <p>Un saludo {props.fechaActual+""}</p>
    </div>
  )
}

export default Fecha