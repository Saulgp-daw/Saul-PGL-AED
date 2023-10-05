import React, { useState } from 'react'
import Multiplicar from './multiplicar';
import Palabra from './palabra';


type Props = {}

const Practica17 = (props: Props) => {
    const [texto, setTextoState] = useState('');

    const cambiarTexto = (event:any) => {
        setTextoState(event.target.value);
    }

    const variableTipo = () => {
       if(!isNaN(parseFloat(texto))){
            console.log("Es un número");
        }else{
            console.log("Es texto");
            
        }

        return (
            <>
            (!isNaN(parseFloat(texto))) ? <Multiplicar numero={parseFloat(texto)} /> : <Palabra palabra={texto} />
            </>
        )
    }

    return (
        <>
            <div>practica17</div>
            <textarea name="textarea" id="textarea" value={texto} onChange={cambiarTexto}></textarea>
            <button onClick={variableTipo}>Recoger Valor</button>
            <p>Valor del textarea: {texto}</p>
            
        </>
    )
}

export default Practica17