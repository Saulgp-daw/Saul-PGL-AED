import React, { useEffect, useState } from 'react'
import RelojActivo from './RelojActivo';
import Reloj from '../Reloj';

type Props = {}

const RelojMundialActivo = (props: Props) => {
    /*const [fechaActual, setFechaActual] = useState<string>("");
    useEffect( () => {
        const timerID = setInterval(tick, 3000);
    }, []);

    function tick(){
        const newFecha = ""+new Date();
        setFechaActual(newFecha);
    }*/



    let zonasHorarias = ["Europe/Madrid", "Europe/London", "America/New_York", "America/Los_Angeles", "Europe/Berlin", "Asia/Tokyo"];
    return (
      <div className='grid'>
          {
            zonasHorarias.map( zona => {
              return <RelojActivo zona={zona} />
            })
          }
      </div>
    )
}

export default RelojMundialActivo