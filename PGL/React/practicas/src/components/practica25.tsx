import React, { useRef, useState } from 'react'

type Props = {}

const Practica25 = (props: Props) => {
    const aleatorios = useRef<number[]>([]);
    const [numeros, setNumeros] = useState<number[]>([]);

    function agregarAleatorio(){
        const aleatorio = Math.floor(Math.random()* 10);
        aleatorios.current.push(aleatorio);
    }

    function guardarAleatorios(){
        setNumeros([...aleatorios.current]);
    }
  return (
    <div>
        <button onClick={agregarAleatorio}>Aleatorio</button>
        <button onClick={guardarAleatorios}>Guardar y mostrar</button>
        <p>{
            numeros.map(element => {
                return element+", ";
            })
        }</p>
    </div>
  )
}

export default Practica25