import React from 'react'

type Props = {}

const Practica33 = (props: Props) => {
  return (
    <div>
        <h3>Practica 33</h3>
        <form onSubmit={mostrarPrimos}>
            <label htmlFor="primoMayor">Primo mayor que: </label>
            <input type="number" /><br />
            <label htmlFor="primoMenor">Primos menores que:</label>
            <input type="number" />
        </form>
    </div>
  )
}

export default Practica33