import React, { useEffect, useState } from 'react'
import useTablero from '../hooks/useTablero';
import usePartida from '../hooks/usePartida';
import { usePartidaContext } from '../contexts/PartidaContextProvider';

type Props = {}

const Tablero: React.FC<Props> = () => {
    const { renderizarTabla } = useTablero();
    const { crearPartida } = usePartida();
    const {partida, setpartida} = usePartidaContext();

    
    

    return (
        <div>
            <h3>Tablero</h3>
            <form onSubmit={(e) => crearPartida(e)}>
                <label htmlFor="J1">Nombre Jugador 1 (O): </label>
                <input type="text" placeholder='Pepe' name='nombreJ1' required/><br />
                <label htmlFor="J2">Nombre Jugador 2 (X): </label>
                <input type="text" placeholder='Luis' name='nombreJ2' required/><br />
                <button type='submit'>Empezar</button>
            </form>
            {partida != null && partida.getJ1() != ""? (
                renderizarTabla()
            ) : null
            }

            
        </div>
    )
}

export default Tablero