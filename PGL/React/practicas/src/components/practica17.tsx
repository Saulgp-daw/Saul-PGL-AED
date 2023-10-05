import React, { useState } from 'react'
import Multiplicar from './multiplicar';
import Palabra from './palabra';


type Props = {}

const Practica17 = (props: Props) => {
    const [texto, setTextoState] = useState('');
    const  [componenteElegido, setComponenteElegido] = useState(false);

    const cambiarTexto = (event: React.ChangeEvent<HTMLInputElement>) => {
        setTextoState(event.target.value );
    }

    function variableTipoNumero() {
        
       if(!isNaN(parseFloat(texto))){
            console.log("Es un número");
            setComponenteElegido(true);
        }else{
            console.log("Es texto");
            setComponenteElegido(false);
        }

      
    }

    return (
        <>
            <div>practica17</div>
            <input name="textarea" id="textarea" value={texto} onChange={cambiarTexto}></input>
            <button onClick={variableTipoNumero}>Recoger Valor</button>
            <p>Valor del textarea: {texto}</p>
            { componenteElegido && texto != ""?  <Multiplicar numero={parseFloat(texto)} />: <Palabra palabra={texto} /> };
           
        </>
    )
}

export default Practica17