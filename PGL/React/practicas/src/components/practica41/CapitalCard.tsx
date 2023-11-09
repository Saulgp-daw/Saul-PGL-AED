import React from 'react'

type Props = {
    capital: Capital;
}

interface Capital {
  id: string;
  nombre: string;
  foto: string;
  datos: Array<Datos>
}

type Datos = {
  anio: number;
  poblacion: number;

}

const CapitalCard = (props: Props) => {
    const capitalActual = props.capital;
  return (
    <>
        <h3>{capitalActual.nombre}</h3>
        <img src={"http://localhost:3000/"+capitalActual.foto} alt={capitalActual.nombre} /> <br />
        {
          capitalActual.datos.map( dato => (
            <p>Año: {dato.anio} - Población: {dato.poblacion}</p>
          ))
        }
    </>
  )
}

export default CapitalCard