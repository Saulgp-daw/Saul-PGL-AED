import React, { useState } from 'react'

type Props = {}

const Practica29 = (props: Props) => {
    const [numeroActual, setNumeroActual] = useState(Math.floor(Math.random()*100));
    const [dividir, setDividir] = useState(true);

    function cambiarEstado(estado: boolean){
        if(estado){
            setNumeroActual(numeroActual/2);
        }else{
            setNumeroActual(numeroActual*2);
        }
    }

  return (
    <div>
        <h3>Practica 29</h3>
        <h4>Número actual: {numeroActual}</h4>
        <button onClick={() => cambiarEstado(true)}>{numeroActual} / 2</button>
        <button onClick={() => cambiarEstado(false)}>{numeroActual} * 2</button>
    </div>
  )
}

export default Practica29