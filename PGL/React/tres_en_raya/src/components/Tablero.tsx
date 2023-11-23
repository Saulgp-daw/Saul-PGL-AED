import React from 'react'
import useTablero from '../hooks/useTablero';
import usePartida from '../hooks/usePartida';
import { usePartidaContext } from '../contexts/PartidaContextProvider';
import "../styles/tablero.css";

type Props = {}

const Tablero: React.FC<Props> = () => {
    const { renderizarTabla, tablero } = useTablero();
    const { crearPartida, iniciar } = usePartida();
    const { partida } = usePartidaContext();


    return (
        <div className='tablero'>
            <h3>Tablero</h3>
            <form onSubmit={(e) => crearPartida(e)}>
                {iniciar ? (
                    <div>
                        <label htmlFor="J1">Nombre Jugador 1 (O): </label>
                        <input type="text" placeholder='Pepe' name='nombreJ1' defaultValue={partida.getJ1()} disabled /><br />
                        <label htmlFor="J2">Nombre Jugador 2 (X): </label>
                        <input type="text" placeholder='Luis' name='nombreJ2' defaultValue={partida.getJ2()} disabled /><br />
                    </div>
                ) : (
                    <div>
                        <label htmlFor="J1">Nombre Jugador 1 (O): </label>
                        <input type="text" placeholder='Pepe' name='nombreJ1' required /><br />
                        <label htmlFor="J2">Nombre Jugador 2 (X): </label>
                        <input type="text" placeholder='Luis' name='nombreJ2' required /><br />
                        <button type='submit'>Empezar</button>
                    </div>
                )}
            </form>

            {iniciar ? (
                <div>
                    {renderizarTabla(tablero)}
                    <p>Estado de la partida: Resultado - {partida.getGanador()}</p>
                </div>
            ) : null}

        </div>
    )
}

export default Tablero