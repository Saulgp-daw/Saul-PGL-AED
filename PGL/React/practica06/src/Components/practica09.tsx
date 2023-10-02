import React, { useState } from 'react';

const MultiplicationTable = () => {

     
    const [numero, setnumero] = useState(1);

    const calcularMultiplicacion = () => {
        const multiplicador = 2;
        const result = multiplicador * (numero % 10 || 10);
        return `${multiplicador}x${numero % 10 ?? 10} = ${result}`;
    };

    const handleClick = () => {
        setnumero(numero + 1);
    };

    return (
        <div>
            <h2>Tabla del 2</h2>
            <button onClick={handleClick}>2x{numero % 10 || 10}</button>
            <p>{calcularMultiplicacion()}</p>
        </div>
    );
};

export default MultiplicationTable;

