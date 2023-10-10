import React, { ChangeEvent, useRef } from 'react'

type Props = {}

const Practica28 = (props: Props) => {
const spanInput = useRef<HTMLInputElement>({} as HTMLInputElement);

function cambiarTexto(event:ChangeEvent<HTMLInputElement>){
    event.preventDefault();
    spanInput.current.innerText = event.currentTarget.value;
}

  return (
    <div>
        <h3>Práctica 28</h3>
        <label htmlFor="nombre">Nombre: </label><input type="text" onChange={cambiarTexto} />
        <p>Has escrito: <span ref={spanInput}></span></p>
    </div>
  )
}

export default Practica28