import React from 'react'
import Partida from './Partida'
import ReactWebSocket from '../components/ReactWebSocket'

type Props = {}

const Pantalla = (props: Props) => {
  return (
    <div style={{
        display: 'grid',
        gridTemplateColumns: '1fr 1fr', // Dos columnas
        gridTemplateRows: '100vh',      // Una fila que ocupa el 100% de la altura
        gap: '10px',                    // Espacio entre las columnas
        }}>
        <div style={{ gridArea: '1 / 1 / 2 / 2' }}>
            <Partida/>
        </div>
        <div style={{ gridArea: '1 / 2 / 2 / 3' }}>
            <ReactWebSocket/>
        </div>
      </div>
      
  )
}

export default Pantalla