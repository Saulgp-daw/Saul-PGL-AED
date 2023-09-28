import React from "react";
const ComponenteApp = () => {
    const misDatos = {"Nombre": "Saúl", "Apellidos ": "González Pérez", "Estudios " : "DAM, DAW, Bachiller"};
    return (
        <>
            <h1>Mis datos:</h1>
            <h4>{JSON.stringify(misDatos)}</h4>
        </>
    );
}
export default ComponenteApp