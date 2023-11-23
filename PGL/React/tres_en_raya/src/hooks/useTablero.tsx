import React, { useState } from 'react'
import { usePartidaContext } from '../contexts/PartidaContextProvider';
import { Partida } from '../models/Partida';
import usePartida from './usePartida';

type Props = {}

const useTablero = () => {
    const [valor, setValor] = useState(false);
    const {partida, setpartida} = usePartidaContext();
    const { guardarPartidaJSON } = usePartida();
    
    const [tablero, setTablero] = useState<string[][]>([
        ["", "", ""],
        ["", "", ""],
        ["", "", ""],
    ]);

    function agregarACelda(fila: number, columna: number) {
        if (!tablero[fila][columna]) {
            const nuevoTablero = [...tablero];
            const nuevoValor: string = valor ? "X" : "O";
            setValor(!valor);
            nuevoTablero[fila][columna] = nuevoValor;
            setTablero(nuevoTablero);
            condicionVictoria(nuevoTablero);
        }
    }

    function condicionVictoria(tablero: string[][]) {
        const valores: string[] = ["O", "X"];

        valores.forEach(valor => {
            for (let i: number = 0; i < 3; i++) {
                if (tablero[i][0] === valor && tablero[i][1] === valor && tablero[i][2] === valor) {
                    let nuevaPartida: Partida = salvarPartida(valor);
                    alert("Victoria para "+nuevaPartida.getGanador()); 
                }
                if (tablero[0][i] === valor && tablero[1][i] === valor && tablero[2][i] === valor) {
                    let nuevaPartida: Partida = salvarPartida(valor);
                    alert("Victoria para "+nuevaPartida.getGanador()); 
                }
            }
            //diagonal principal
            if (tablero[0][0] === valor && tablero[1][1] === valor && tablero[2][2] === valor) {
                let nuevaPartida: Partida = salvarPartida(valor);
                alert("Victoria para "+nuevaPartida.getGanador()); 
            }
        
            // diagonal secundaria
            if (tablero[0][2] === valor && tablero[1][1] === valor && tablero[2][0] === valor) {
                let nuevaPartida: Partida = salvarPartida(valor);
                alert("Victoria para "+nuevaPartida.getGanador()); 
            }
        });
    }

    function salvarPartida(valor: string): Partida{
        const nuevaPartida = new Partida(partida.getId(), partida.getJ1(), partida.getJ2(), tablero, descubrirGanador(valor));
        setpartida(nuevaPartida);
        //console.log(nuevaPartida);
        guardarPartidaJSON(nuevaPartida);
        return nuevaPartida;
    }
    
    function descubrirGanador(valor: string): string{
        let ganador: string = "J2: "+partida.getJ2();
        if(valor === "O"){
            ganador = "J1: "+partida.getJ1();
        }
        
        return ganador;
    }

    const renderizarTabla = () => (
        <table border={1} style={{ width: '300px', height: '300px' }}>
            {tablero.map((fila, indiceFila) => (
                <tr key={indiceFila}>
                    {fila.map((celda, indiceColumna) => (
                        <td style={{ width: '100px', height: '100px' }} key={indiceColumna} onClick={() => agregarACelda(indiceFila, indiceColumna)}>{celda}</td>
                    ))}
                </tr>
            ))}
        </table>
    );
    return { valor, setValor, tablero, setTablero, agregarACelda, renderizarTabla }
}

export default useTablero