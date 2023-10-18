import React, { useState } from 'react'

type Props = {}

const Practica33 = (props: Props) => {
  const [numerosPrimos, setNumerosPrimos] = useState<Array<number>>([]);

  function mostrarPrimos(event: React.FormEvent<HTMLFormElement>){
    event.preventDefault();
    let formulario = event.currentTarget;
    const menor = Number(formulario.menor.value) ?? 0;
    const mayor = Number(formulario.mayor.value) ?? 100;

    let primos: number[] = [];

    for (let i = menor; i <= mayor; i++) {
      let esPrimo = true;

      if (i > 1) {
        for (let j = 2; j <= Math.sqrt(i); j++) {
          if (i % j === 0) {
            esPrimo = false;
            break;
          }
        }
        if (esPrimo) {
          primos.push(i);
        }
      }
    }

    setNumerosPrimos(primos);
  }
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