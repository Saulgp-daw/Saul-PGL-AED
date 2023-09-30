import React, { useState } from "react";
type Props = {}
const FCContador = (props: Props) => {
    const [contador, incrementar] = useState(0);
    return (
        <>
            <p>Has hecho click {contador} veces</p>
            <button onClick={() => incrementar(contador + 1)}>
                Haz click!
            </button>
        </>  
    );
}
export default FCContador;