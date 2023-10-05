import React, { useState } from 'react';

type Props = {
    numero: number
}

const Tabla = (props: Props) => {

     
    const [numero, setnumero] = useState(1);
    const multiplicador = props.numero;

    const calcularMultiplicacion = () => {
        
        const result = multiplicador * (numero % 10 || 10);
        return `${multiplicador}x${numero % 10 || 10} = ${result}`;
    };

    const handleClick = () => {
        setnumero(numero + 1);
    };

    return (
        <div className='box'>
            <h2>Tabla del {multiplicador}</h2>
            <button onClick={handleClick}>{multiplicador}x{numero % 10 || 10}</button>
            <p>{calcularMultiplicacion()}</p>
        </div>
    );
};

export default Tabla;

