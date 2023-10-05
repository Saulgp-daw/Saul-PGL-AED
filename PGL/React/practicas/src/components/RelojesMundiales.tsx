import React from 'react';
import Reloj from './Reloj';

type Props = {}
function RelojesMundiales({}: Props) {

  let zonasHorarias = ["Europe/Madrid", "Europe/London", "America/New_York", "America/Los_Angeles", "Europe/Berlin", "Asia/Tokyo"];
  return (
    <div className='grid'>
        {
          zonasHorarias.map( zona => {
            return <Reloj zona={zona} />
          })
        }
    </div>
  )
}

export default RelojesMundiales