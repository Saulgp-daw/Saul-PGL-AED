import React, { useRef, useState } from 'react'
const Practica23 = () => {

    const inputNombre = useRef<HTMLInputElement>({} as HTMLInputElement);
    const inputApellidos = useRef<HTMLInputElement>({} as HTMLInputElement);
    const divresultado = useRef<HTMLInputElement>({} as HTMLInputElement);



    function tratarDatos() {
        let htmlInputNombre = inputNombre.current;
        let htmlInputApellidos = inputApellidos.current;
        let totalCaracteresNombre = htmlInputNombre.value.length;
        let htmldivResultado = divresultado.current;
        htmldivResultado.innerText = htmlInputNombre.value+" "+htmlInputApellidos.value+" y el nombre tiene "+totalCaracteresNombre+" caracteres.";
        
    }
    return (
        <div>
            <h4>Práctica 23</h4>
            <input type="text" ref={inputNombre} />
            <input type="text" ref={inputApellidos} />
            <button onClick={tratarDatos}>Enviar</button>
            <p ref={divresultado}></p>
            
        </div>
    )
}
export default Practica23