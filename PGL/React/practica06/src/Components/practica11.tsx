import React from 'react'



const Practica11 =()=>{
    function saludoSinParametros() {
        alert("hola Amigo!");
    }
    function saludoConParametros(mensaje: string) {
        alert(mensaje);
    }
    return (
        <>
            <h3>Realizando saludos:</h3>
            <p>Sin parámetros: <button onClick={saludoSinParametros}>amigo</button></p>
            <p>Con params: <button onClick={() => saludoConParametros("saludos Ana")}>ana</button></p>
            <p>Con params: <button onClick={() => saludoConParametros("saludos Marta")}>mara</button></p>
        </>
    )
}

export default Practica11