import React from "react";
const ComponenteMostrarHora = (props: any) => {
    const mostrarHora = () => {
        alert(new Date());
    }
    return (
        <>
            <h1> Pulsar en el botón para ver la hora</h1>
            <button onClick={mostrarHora}>Pulsar</button>
        </>
    );
}
export default ComponenteMostrarHora;