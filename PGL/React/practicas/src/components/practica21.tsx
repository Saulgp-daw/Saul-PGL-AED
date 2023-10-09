import React, { useEffect, useState } from 'react'

type Props = {}

const EjemploRelojActivo = (props: Props) => {
    const [fechaActual, setFechaActual] = useState<string>("");
    useEffect( () => {
        const timerID = setInterval(tick, 1000);
    }, []);

    function tick(){
        const newFecha = ""+new Date();
        setFechaActual(newFecha);
    }



  return (
    <div>
        <h3>Ejemplo Reloj Dinámico</h3>
        {fechaActual}
    </div>
  )
}

export default EjemploRelojActivo