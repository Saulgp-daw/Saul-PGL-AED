import React, { useState } from 'react'
import Multiplicar from './multiplicar';
import Palabra from './palabra';
import NumerosAleatorios from './numerosAleatorios';
import Fecha from './fecha';


type Props = {}

const Practica17 = (props: Props) => {
    const [texto, setTextoState] = useState('');
    const  [componenteElegido, setComponenteElegido] = useState(false);

    function generarNumerosAleatorios(){
        setComponenteElegido(true);
    }

    function fechaYSaludar(){
        setComponenteElegido(false);
    }

    return (
        <>
            <div>practica17</div>
            <button onClick={generarNumerosAleatorios}>Numeros aleatorios</button>
            <button  onClick={fechaYSaludar}>Fecha</button>
            { componenteElegido?  <NumerosAleatorios />: <Fecha fechaActual={new Date()} /> }
           
        </>
    )
}

export default Practica17