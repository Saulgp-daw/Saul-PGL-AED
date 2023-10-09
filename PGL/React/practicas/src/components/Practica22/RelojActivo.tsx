import React, { useEffect, useState } from 'react'

type Props = {
    zona?: string;
  }

const RelojActivo = (props: Props) => {
    const [fechaActual, setFechaActual] = useState<string>("");

    useEffect( () => {
        const timerID = setInterval(tick, 1000);
    }, []);

    function tick(){
        const zona = props.zona ?? "Europe/London";
        const newFecha = ""+new Date().toLocaleString("es-ES", {timeZone: zona});
        setFechaActual(newFecha);
    }



    return (
        <div className='zonaHoraria'>
          <h5>{props.zona}</h5>
          <p>{fechaActual}</p>
        </div>
      )
}

export default RelojActivo