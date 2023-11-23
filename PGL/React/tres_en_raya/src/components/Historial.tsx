import React from 'react'
import useObtenerPartidas from '../hooks/useObtenerPartidas'
import useTablero from '../hooks/useTablero';
import usePartida from '../hooks/usePartida';

type Props = {}

const Historial = (props: Props) => {
  const { arrayPartidas } = useObtenerPartidas();
  const { renderizarTabla } = useTablero();
  const { borrarPartidaJSON } = usePartida();
  console.log(arrayPartidas);
  
  return (
    <div>
      <h3>Historial</h3>
      {
        arrayPartidas.partidas.map(partida => (
          <div>
            <span>
              Id: {partida.getId()+" - J1: "+partida.getJ1()+" - J2: "+partida.getJ2()}{renderizarTabla(partida.getTablero(), 100, 100)} Ganador: {partida.getGanador()}
              <button onClick={() => borrarPartidaJSON(partida)}>Borrar</button>
            </span>
          </div>
        ))
      }
    </div>
  )
}

export default Historial