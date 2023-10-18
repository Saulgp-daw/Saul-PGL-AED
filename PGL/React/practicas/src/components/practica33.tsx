import React, { useState } from 'react'
import usePractica33 from '../hooks/usePractica33'

type Props = {}

const Practica33 = (props: Props) => {
  const {mostrarPrimos, numerosPrimos} = usePractica33();
  return (
    <div>
        <h3>Practica 33</h3>
        <form onSubmit={mostrarPrimos}>
            <label htmlFor="menor">Número mínimo: </label>
            <input type="number" name='menor' /><br />
            <label htmlFor="mayor">Número máximo:</label>
            <input type="number" name='mayor'/> <br />
            <button type='submit'>Enviar</button>
        </form>
        {
          numerosPrimos.map( num => (
            <p>{num}</p>
          ))
        }
    </div>
  )
}

export default Practica33