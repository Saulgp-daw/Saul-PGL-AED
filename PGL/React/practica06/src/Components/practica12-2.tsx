import React, { useState } from 'react'

//Práctica adicional propuesta en clase

type ContadorState = {
    repAzul: number,
    repVerde: number
}

const Practica12 =()=>{

    const [color, colorState] = useState("verde");
    const [contador, setContador] = useState({repAzul: 0, repVerde: 0} as ContadorState);


    function eligeColor(color: string) {
        colorState(color);
        let nuevoContadores = {} as ContadorState;
        switch(color){
            case "verde": 
            nuevoContadores = {repVerde: contador.repVerde+1, repAzul: contador.repAzul};
                break;
            case "azul":
            nuevoContadores = {repVerde: contador.repVerde, repAzul: contador.repAzul+1};
                break;

            default:
                console.log();
                
                break;
            
        }
        setContador(nuevoContadores);
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