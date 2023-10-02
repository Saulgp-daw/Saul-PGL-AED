import React, { useState } from 'react'



const Practica12 =()=>{

    const [color, colorState] = useState("verde");

    function eligeColor(color: string) {
        colorState(color);
    }


    return (
        <>
            <h3>Elige un color:</h3>
            <p>Has elegido:  {color}</p>
            <p>Con params: <button onClick={() => eligeColor("verde")}>verde</button></p>
            <p>Con params: <button onClick={() => eligeColor("azul")}>azul</button></p>
        </>
    )
}

export default Practica12