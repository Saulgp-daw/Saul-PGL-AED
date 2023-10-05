import React from 'react';

type Props = {
  zona?: string;
}

const Reloj = (props: Props) => {
  const zona = props.zona ?? "Europe/London";
  const fecha = new Date().toLocaleString("es-ES", {timeZone: zona});

  return (
    <div className='zonaHoraria'>
      <h5>{props.zona}</h5>
      <p>{fecha}</p>
    </div>
  )
}

export default Reloj