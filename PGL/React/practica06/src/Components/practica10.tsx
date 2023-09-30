import React, { useState } from "react";
const ComponenteArrayAleatorio= (props: any) => {
    const [arrayNumeros, setArray] = useState<number[]>([]);

    const agregarElemento = () => {
        const numAleatorio: number = Math.floor(Math.random() * 100) + 1;
        setArray([...arrayNumeros, numAleatorio]);
    };

    return (
        <>
            <div>practica10</div>
            <p>{JSON.stringify(arrayNumeros)}</p>
            <button onClick={agregarElemento}>Agregar otro aleatorio al array</button>
        </>
    );
}
export default ComponenteArrayAleatorio;