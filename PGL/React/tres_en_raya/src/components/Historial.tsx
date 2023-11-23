import React from 'react'
import useObtenerPartidas from '../hooks/useObtenerPartidas'
import useTablero from '../hooks/useTablero';
import { usePartidaContext } from '../contexts/PartidaContextProvider';
import usePartida from '../hooks/usePartida';

type Props = {}

const Historial = (props: Props) => {
  const { arrayPartidas } = useObtenerPartidas();
  const { renderizarTabla } = useTablero();
  const { cargarPartida } = usePartida();
  console.log(arrayPartidas);
  
  return (
    <div>
      <h3>Historial</h3>
      {
        arrayPartidas.partidas.map(partida => (
          <div onClick={()=>cargarPartida(partida)}>
            <span>Id: {partida.getId()+" - J1: "+partida.getJ1()+" - J2: "+partida.getJ2()}{renderizarTabla(partida.getTablero(), 100, 100)} Ganador: {partida.getGanador()}</span>
          </div>
        ))
      }
    </div>
  )
}

export default Historial